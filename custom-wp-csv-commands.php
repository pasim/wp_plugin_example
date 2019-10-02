<?php

/**
 *
 */


WP_CLI::add_command( 'csv_staff', 'Csv_CLI_commands' );

class Csv_CLI_commands extends WP_CLI_Command {


  private $strings = [

    'Some random string that also has this string: [soundcloud url="https://api.soundcloud.com/tracks/910291" params="auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true" width="100%" height="450" iframe="true" /] in it.',

    'Another completely random string that also has this string: [soundcloud url="https://api.soundcloud.com/tracks/5678?secret=test" params="auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true" width="100%" height="450" iframe="true" /] in it test .',

    'Something else completely random string that also has this string: [soundcloud url="https://api.soundcloud.com/tracks/12345?secret=test" params="auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true" width="100%" height="450" iframe="true" /] in i112222t.'
  ];

  public function display_replaced() {

    $file = plugin_dir_path(__FILE__) . '/data/data.csv';

    if (($handle = fopen($file, "r")) !== FALSE) {
      //skip the first line with column names
      fgetcsv($handle, 1000, ",");
      $i = 0;
      while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        //print_r($data);
        if (is_array($data)) {

          preg_match('/^[a-zA-Z ]+\\: \\[[a-z]+ url=\\"(https:\\/\\/.*)\\".*\\/\\]( [a-zA-Z0-9 ]+\\.)$/', $this->strings[$i], $matches);
          //print_r($matches);
          if (strpos($matches[1], $data[0]) !== FALSE) {

            //Print to screen to test an verify
            print preg_replace([
                '/soundcloud /',
                '/url="/',
                '/https:\\/\\/.*\\/\\]/'
              ], [
                "different-embed ",
                'src="',
                $data[1] . '"]'
              ], $this->strings[$i]) . "\n";
            $this->strings[$i] = preg_replace([
              '/soundcloud /',
              '/url="/',
              '/https:\\/\\/.*\\/\\]/'
            ], [
              "different-embed ",
              'src="',
              $data[1] . '"]'
            ], $this->strings[$i]);
          }


          $i++;
        }
      }

      fclose($handle);

    }

    /**
     * Lets display chaged array
     */
    foreach ($this->strings as $string){
      print $string."\n";
    }

  }

}
