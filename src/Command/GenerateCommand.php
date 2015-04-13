<?php
/**
 * Created by PhpStorm.
 * User: cnam
 * Date: 13/04/15
 * Time: 09:43
 */

namespace Cnam\Command;


use Cnam\Generator;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $inputFile = $input->getArgument('input');
        $outputFile = $input->getArgument('output');

        $generator = new Generator();

        if (!file_exists($inputFile)) {
            $output->writeln('<error>Input file require not exists<error>', OutputInterface::VERBOSITY_QUIET);
            return;
        }

        if (empty($outputFile)) {
            $output->writeln('<error>Output file cannot be empty<error>', OutputInterface::VERBOSITY_QUIET);
            return;
        }

        try {
            $generator->parse(realpath($inputFile));
            $generator->generate($outputFile);
            $text = '<info>api generate success for run copy text file://'.realpath($outputFile).'<info>';
        } catch (\Exception $e) {
            $text = '<error>'.$e->getMessage().'<error>';
        }

        $output->writeln($text);
    }
}
