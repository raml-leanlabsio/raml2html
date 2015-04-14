<?php

namespace Cnam\Command;


use Cnam\Generator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WatchCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('watch')
            ->setDescription('<info>Generator html documentation from raml file<info>')
            ->addOption(
                'input',
                'i',
                InputOption::VALUE_REQUIRED,
                'You need to specify the RAML input file'
            )
            ->addOption(
                'output',
                'o',
                InputOption::VALUE_REQUIRED,
                'You need to specify the Html Output file'
            );
    }

    protected function execute(InputInterface $input, OutputInterface $stdout)
    {
        /*$inputFile = $input->getArgument('input');
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

        $stdout->writeln($text);*/
    }

}
