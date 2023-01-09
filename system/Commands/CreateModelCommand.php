<?php

namespace System\Commands;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use SebastianBergmann\CodeCoverage\Report\PHP;

use function PHPUnit\Framework\fileExists;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;

use Symfony\Component\Console\Output\OutputInterface;

use System\Database\ORM\Model;

// the "name" and "description" arguments of AsCommand replace the
// static $defaultName and $defaultDescription properties
#[AsCommand(
    name: 'app:create-model',
    description: 'Creates a new user.',
    hidden: false,
    aliases: ['app:create-model']
)]

class CreateModelCommand extends Command
{
    const STUB_FILE =   __DIR__ . '/../../stubs/model.stub';
    const OUTPUT_PATH = __DIR__ . '/../../app/';

    //get stub file

    public function getStubFile(): mixed
    {
        $file = file_get_contents(self::STUB_FILE);
        return $file;
    }

    //check file exists

    public function fileExists(string $pathFile): bool
    {
        return file_exists($pathFile);
    }

    // create output file if it creates successfuly it return true but on the other hand return false
    // it takes two parameters one of them as string for Model name and Output file name
    //second one gets parmaters to set in our stub



    public function createFile(string $fileName, array $params): bool
    {
        $pattern = '/{{ (.*?) }}/';

        $trimName = Str::replaceLast('s', '', $fileName);

        $fileName = Str::ucfirst($trimName);

        $outputFile = self::OUTPUT_PATH . $fileName . '.php';


        $modelFile = $this->getStubFile();


        $modelFile =  preg_replace_callback(
            $pattern,
            function ($match) use ($params) {
                return $params[$match[1]] ?? '';
            },
            $modelFile
        );

        if ($this->fileExists($outputFile)) {

            return false;
        }


        file_put_contents($outputFile, $modelFile);

        return true;
    }

    // get the parameters in type of an array
    //it will get the input Argument as input name and modify it 
    // afte the modify it will be return an array with related indexes for our stub

    public function getParams(string $inputName): array
    {

        $trimName = Str::replaceLast('s', '', $inputName);

        $class = Str::ucfirst($trimName);
        $clas2 = Str::lower($inputName);

        $params = [
            'namespace' => 'App',
            'class' => $class,
            'class2' => $clas2
        ];

        return $params;
    }

    //config the input argument that it recives from CLI 

    protected function configure(): void
    {
        $this->addArgument('model', InputArgument::REQUIRED, 'The name of the model.');
    }



    //execute our command

    public function execute(InputInterface $input, OutputInterface $output): int
    {


        $create = $this->createFile($input->getArgument('model'), $this->getParams($input->getArgument('model')));

        if ($create) {
            $output->write('successfully created:)');

            return Command::SUCCESS;
        }

        $output->write('successfully failed:)');

        return Command::FAILURE;
    }
}
