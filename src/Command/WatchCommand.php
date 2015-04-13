<?php

namespace Cnam\Command;


use Cnam\Generator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WatchCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('generate')
            ->setDescription('Generator html documentation from raml file')
            ->addArgument(
                'input',
                null,
                'Input file *.raml'
            )
            ->addArgument(
                'output',
                null,
                'Output file *.raml'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $stdout)
    {
        $inputFile = $input->getArgument('input');
        $outputFile = $input->getArgument('output');

        $stderr = $stdout instanceof ConsoleOutputInterface
            ? $stdout->getErrorOutput()
            : $stdout;

        $generator = new Generator();

        try {
            while (true) {

                str_replace(realpath($inputFile), '', $inputFile);

                $generator->parse(realpath($inputFile));
                $generator->generate($outputFile);
            }

            $text = 'api generate success for run copy text file://'.realpath($outputFile);
        } catch (\Exception $e) {
            $text = $e->getMessage();
        }

        $stdout->writeln($text);
    }

}
