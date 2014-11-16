<?php
/**
 * PHPUnit test for GitHubInfiltration class
 */
require_once 'GitHubInfiltration.php';

class GitHubInfiltrationTest extends PHPUnit_Framework_TestCase {

    /**
     * @dataProvider provider Checking if method GitHubInfiltration::endsWithNumber really returns TRUE for hashes ending with number.
     * Checking the test result messages demonstrates and allows to compare commit's hash with the tested method result.
     */
    public function testEndsWithNumber($sha) {
        $this->assertFalse(GitHubInfiltration::endsWithNumber($sha), 'Hash ' . $sha . ' is ending with number.');
    }

    /**
     * Getting the GitHub commits for test.
     * @dataProvider provider
     */
    public function provider()
    {
        $gitHub = new GitHubInfiltration();
        $shaList = array();
        $commitsList = $gitHub->getCommits();
        foreach ($commitsList as $commit)
        {
            $shaList[] = array($commit['sha']);
        }
        return $shaList;
    }

}