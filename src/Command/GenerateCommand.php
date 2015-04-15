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
use Symfony\Component\Console\Helper\DescriptorHelper;
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

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $inputFile = $input->getOption('input');
        $inputFileReal = realpath($inputFile);
        $outputFile = $input->getOption('output');

        $generator = new Generator();

        if (empty($inputFile) || ! file_exists($inputFileReal)) {
            $output->writeln('<error>Error: You need to specify the RAML input file</error>'.PHP_EOL, OutputInterface::VERBOSITY_QUIET);
            $this->viewHelp($input, $output);
            return;
        }

        if (empty($outputFile)) {
            $output->writeln('<error>Output file cannot be empty</error>'.PHP_EOL, OutputInterface::VERBOSITY_QUIET);
            $this->viewHelp($input, $output);
            return;
        }

        try {
            $generator->parse($inputFileReal);
            $generator->generate($outputFile);
            $text = '<info>api generate success for run copy text</info>'
                     .PHP_EOL.'file://'.realpath($outputFile).PHP_EOL;
        } catch (\Exception $e) {
            $text = '<error>'.$e->getMessage().'</error>'.PHP_EOL;
            $text .= $e->getFile().' '.$e->getLine().PHP_EOL;
            $text .= $e->getTraceAsString().PHP_EOL;
        }

        $output->writeln($text);
    }

    protected function viewHelp(InputInterface $input, OutputInterface $output)
    {
        $helper = new DescriptorHelper();
        $helper->describe($output, $this, array(
            'raw_text' => false,
            'format' => 'txt',
        ));
    }
}
