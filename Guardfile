guard 'phpunit2', tests_path: 'tests', cli: '--colors -c phpunit.xml', command: "./vendor/bin/phpunit" do
  # Watch tests files
  watch(%r{^.+Test\.php$})

  # Watch library files and run their tests
  watch(%r{^src/(.+)\.php}) { |m| "tests/Unit/#{m[1]}Test.php" }
end
