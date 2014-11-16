<?php
require 'GitHubInfiltration.php';
$gitHub = new GitHubInfiltration();
$commitsList = $gitHub->getCommits();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>GitHub Infiltration</title>
    <link href="commits.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div id="main-cont">
        <h1>GitHub API v3 in action !</h1>
        <h6>(See: <a target="_blank" href="https://developer.github.com/v3/git/commits/">https://developer.github.com/v3/git/commits/</a>)</h6>
        <table>
            <tr>
                <th>Hash</th>
                <th>Message</th>
                <th>Author</th>
                <th>Date</th>
            </tr>
            <?php
            foreach ($commitsList as $commit)
            {
                $rowCss = (GitHubInfiltration::endsWithNumber($commit['sha'])) ? ' class="special-row"' : '';
            ?>
                <tr<?php echo $rowCss ?>>
                    <td>
                        <a target="_blank" href="<?php echo $commit['html_url'] ?>"><?php echo $commit['sha'] ?></a>
                    </td>
                    <td>
                        <?php echo htmlspecialchars($commit['commit']['message']) ?>
                    </td>
                    <td class="no-wrap">
                        <a href="mailto:<?php echo $commit['commit']['author']['email'] ?>"><?php echo htmlspecialchars($commit['commit']['author']['name']) ?></a>
                    </td>
                    <td class="no-wrap">
                        <?php echo date('m/d/Y H:i', strtotime($commit['commit']['author']['date'])); ?>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>