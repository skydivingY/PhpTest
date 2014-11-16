<?php
/**
 * GitHub operations class.
 * Based on the GitHub API v3.
 * See: https://developer.github.com/v3/git/commits/
 */

class GitHubInfiltration {

    /**
     * A number of commits to get
     * @var int
     */
    private $_commitsCount = 25;

    /**
     * A repository owner
     * @var string
     */
    private $_owner = 'joyent';

    /**
     * A repository name
     * @var string
     */
    private $_repo = 'node';

    /**
     * A repository branch
     * @var string
     */
    private $_branch = 'master';

    /**
     * Connects and retrieves information from GitHub.
     * @param string $url An url for GitHub.
     * @return JSON decoded content.
     */
    private function _getGitHubContent($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($ch, CURLOPT_USERAGENT, (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : 'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0) Opera 12.14');
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        $content = curl_exec($ch);
        curl_close($ch);
        return json_decode($content, true);
    }

    /**
     * Gets the number of last commits from specific GitHub repository.
     * @return JSON decoded content.
     */
    public function getCommits() {
        $commitsList = $this->_getGitHubContent("https://api.github.com/repos/{$this->_owner}/{$this->_repo}/commits?per_page={$this->_commitsCount}&sha={$this->_branch}");
        return $commitsList;
    }

    /**
     * Checks if the hash string is ending with the number.
     * @param string $sha Any hash string to check.
     * @return bool result.
     */
    public static function endsWithNumber($sha) {
        return is_numeric(substr($sha, -1));
    }

} 