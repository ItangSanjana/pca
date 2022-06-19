<?php

namespace Is\Pca;

use \Exception;

class App
{
  public string $input;
  public string $upper_case;
  public string $fancy_letter;
  public string $output;

  public function __construct(array $input)
  {
    if (count($input) < 2) {
      echo 'Usage:' . PHP_EOL;
      echo 'php pca [arguments...] or' . PHP_EOL;
      echo './pca [arguments...]' . PHP_EOL;
      exit;
    }

    $this->input = implode(' ', array_slice($input, 1));
  }

  public function getUpperCase(string $case = null): string
  {
    $this->upper_case = $case ? mb_strtoupper($case) : mb_strtoupper($this->input);

    return $this->upper_case;
  }

  public function getFancyLetter(): string
  {
    $this->fancy_letter = $this->input;

    for ($i = 0, $len = strlen($this->fancy_letter); $i < $len; $i++) {
      if ($i & 1) {
        $this->fancy_letter[$i] = $this->getUpperCase($this->fancy_letter[$i]);
      }
    }

    return $this->fancy_letter;
  }

  public function getCSVFile(): string
  {
    try {
      $list = [mb_str_split($this->input)];
      $stream = fopen('file.csv', 'w');

      if (!$stream) {
        throw new Exception('Failed to open stream');
      }

      foreach ($list as $fields) {
        fputcsv($stream, $fields);
      }

      fclose($stream);

      $this->output = "CSV created!";
    }
    catch (Exception $e) {
      $this->output = $e->getMessage();
    }
    finally {
      return $this->output;
    }
  }
}
