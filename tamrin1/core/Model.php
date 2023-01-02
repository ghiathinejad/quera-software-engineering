<?php

namespace Core;

use PDO;
use Core\DB;
use Exception;
use Illuminate\Support\Str;
use Core\Exceptions\NotFoundException;

use function DI\get;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;
use Core\Exceptions\InvalidInputException;
use PhpParser\Node\Expr\Throw_;

abstract class Model
{

    public static function create(array $data): ?Model
    {
        if (empty($data))
            throw new InvalidInputException('input must have some value');

        $insertedData = DB::get()->insert(static::getTable(), $data);

        if (!$insertedData)
            throw new Exception('failed to insert data');

        return static::convertToClassObject(static::getById(DB::get()->id()));
    }

    public static function getById(int $id): ?Model
    {
        $exist = DB::get()->has(static::getTable(), ['id' => $id]);

        if (!$exist)
            throw new NotFoundException('data with id = '.$id.' did not found');

        $row = DB::get()->get(static::getTable(), '*', ['id' => $id]);

        return static::convertToClassObject($row);
    }

    public static function getList(?string $orderBy = null, string $direction = 'ASC', ?int $page = null, ?int $limit = null): array
    {

        $whereClause = [];

        if (!empty($orderBy)) {
            $whereClause['ORDER'][$orderBy] = $direction;
        }
        if ($page > 0 and $limit > 0) {
            $whereClause['LIMIT'] = [($page - 1) * $limit, $limit];
        }

        $rows = DB::get()->select(static::getTable(), '*', $whereClause);
        $result = [];
        foreach ($rows as $row) {
            $result[] = static::convertToClassObject($row);
        }

        return $result;
    }

    public static function update(int $id, array $data)
    {
        $query = ['id' => $id];
        $exist = DB::get()->has(static::getTable(), $query);


        if (!$exist)
            throw new NotFoundException('data did not found');

        $updated = DB::get()->update(static::getTable(), $data, $query);


        if (!$updated)
            throw new Exception('cannot update this record');


        return self::getById($id);
    }

    public static function delete(int $id): void
    {
        $query = ['id' => $id];
        DB::get()->delete(static::getTable(), $query);
    }

    protected static function convertToClassObject($data): Model
    {
        $object = new static;
        foreach ($data as $key => $value) {
            $object->$key = $value;
        }
        return $object;
    }

    public static function getTable(): string
    {
        return Str::snake(Str::pluralStudly(class_basename(new static)));
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
