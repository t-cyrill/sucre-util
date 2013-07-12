<?php
namespace Sucre;

require dirname(__DIR__).'/vendor/autoload.php';

class SampleApplication extends CLI\Application {
    private $parser;
    private $descriptions;

    private $quiet = false;

    const APP_NAME = 'SampleApplication';
    const VERSION = '1.0.0';

    protected function __construct(array $params = array())
    {
        parent::__construct($params);

        $parser = CLI\OptionParser::factory();
        $parser->addRules(
            array('h', 'help'),
            function (array $params) {
                return ['help' => true];
            }
        )->addRules(
            array('n', 'dry-run'),
            function (array $params) {
                return ['dry-run' => true];
            }
        )->addRule(
            'log-file',
            function (array $params) {
                return ['log-file' => $params[0]];
            }
        )->addRules(
            array('q', 'quiet'),
            function (array $params) {
                return ['quiet' => true];
            }
        )->addRule(
            'v',
            function (array $params) {
                $level = Logger::INFO;
                if (count($params) > 0) {
                    $level = Logger::DEBUG;
                }

                return ['log-level' => $level];
            }
        )->addRule(
            'version',
            function () {
                return ['version' => true];
            }
        );

        $this->parser = $parser;
        $this->descriptions = [
            '-h, --help' => 'print this help.',
            '-n, --dry-run' => 'DRY RUN',
            '--log-file=FILE' => 'log file',
            '-q, --quiet' => 'print nothing',
            '-v' => 'print messages verbosily',
            '-vv' => 'print messages more verbosily',
            '--version' => 'show version',
        ];
    }

    protected function beforeRun(array $options)
    {
        if (isset($options['log-level'])) {
            Logger::setLevel((int) $options['log-level']);
        }

        $logger = Logger\MultiLogger::factory();
        if (!isset($options['quiet'])) {
            $logger->addLogger(Logger\StandardOutLogger::factory());
            $this->quiet = true;
        }

        if (isset($options['log-file'])) {
            $logger->addLogger(Logger\FileLogger::factory($options['log-file']));
        }

        if (!$this->quiet) {
            echo self::APP_NAME.PHP_EOL;
        }
    }

    public function run()
    {
        $options = $this->parser->parse();

        if (isset($options['version'])) {
            echo self::APP_NAME
                .' '
                .self::VERSION
                .' PHP/'.phpversion()
                .PHP_EOL;
            return 0;
        }

        if (isset($options['help'])) {
            echo CLI\HelpMessageBuilder::factory()
                    ->setDescriptions($this->descriptions)
                    ->getMessage();
            return 0;
        }

        $this->beforeRun($options);

        return 0;
    }

    public function addParserRules(array $options, $description, \Closure $callback) {
        $descriptions = array(implode(', ', $options) => $description);

        foreach ($options as &$option) {
            $option = ltrim($option, '-');
        }
        unset($option);

        $this->descriptions = array_merge($this->descriptions, $descriptions);
        $this->parser->addRules($options, $callback);

        return $this;
    }
}

$app = SampleApplication::factory()
    ->addParserRules(
        ['-f', '--force'],
        'force mode true',
        function ($params) {
            return ['force' => true];
        }
    )->run();

