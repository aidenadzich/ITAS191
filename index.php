<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.ico">
    <title>
        <?php
        $currentPath = isset($_GET['path']) ? realpath($_GET['path']) : realpath('.');
        $directoryName = basename($currentPath);
        echo htmlspecialchars($directoryName) . " - Aiden Adzich ITAS186";
        ?>
    </title>    <style>
        body {
            font-family: monospace; /* Classic file system font */
            background: linear-gradient(135deg, #1a1a1a, #2a2a2a);
            color: #eaeaea;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        header {
            background-color: #007BFF;
            color: #fff;
            padding: 15px 20px;
            font-size: 1.2rem;
            border-bottom: 2px solid #0056b3;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }
        .container {
            width: 80%;
            max-width: 800px;
            background-color: #2a2a2a;
            border: 1px solid #444;
            border-radius: 8px;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.5);
            overflow: hidden;
        }
        .content {
            padding: 20px;
        }
        .info {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #333;
            border: 1px solid #444;
            border-radius: 4px;
            font-size: 0.9rem;
            color: #bbb;
        }
        ul {
            list-style-type: none;
            padding-left: 0;
            margin: 0;
        }
        li {
            display: flex;
            align-items: center;
            margin: 8px 0;
            padding: 10px;
            background-color: #333;
            border: 1px solid #444;
            border-radius: 4px;
            transition: background-color 0.2s, transform 0.1s;
        }
        li:hover {
            background-color: #3e3e3e;
            transform: scale(1.01);
        }
        .icon {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }
        .icon.file {
            color: #61dafb;
        }
        .icon.folder {
            color: #f0c674;
        }
        a {
            color: #eaeaea;
            text-decoration: none;
            flex-grow: 1;
        }
        a:hover {
            text-decoration: underline;
        }
        .back-button {
            display: block;
            margin-bottom: 20px;
            padding: 8px 12px;
            background-color: #007BFF;
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.2s;
        }
        .back-button:hover {
            background-color: #0056b3;
        }
        footer {
            text-align: center;
            padding: 10px;
            font-size: 0.8rem;
            background-color: #222;
            color: #777;
            border-top: 1px solid #444;
        }
        .currently-open {
            font-style: italic;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            Directory Listing
        </header>
        <div class="content">
            <?php
            // Get the directory to display, defaulting to the root
            $currentPath = isset($_GET['path']) ? realpath($_GET['path']) : realpath('.');
            $rootPath = realpath('.'); // Set the root directory for reference
            $currentFile = basename(__FILE__); // This file's name

            // Prevent navigating outside the root directory
            if (strpos($currentPath, $rootPath) !== 0) {
                $currentPath = $rootPath;
            }

            // Directory information
            $files = scandir($currentPath);
            $totalFiles = 0;
            $totalFolders = 0;
            $totalSize = 0;

            foreach ($files as $file) {
                if ($file === '.' || $file === '..') {
                    continue;
                }
                if (is_dir($currentPath . DIRECTORY_SEPARATOR . $file)) {
                    $totalFolders++;
                } else {
                    $totalFiles++;
                    $totalSize += filesize($currentPath . DIRECTORY_SEPARATOR . $file);
                }
            }

            // Display Back Button
            if ($currentPath !== $rootPath) {
                $parentPath = dirname($currentPath);
                echo '<a href="?path=' . urlencode($parentPath) . '" class="back-button">← Back to Parent Directory</a>';
            } else {
                echo '<p>You are at the root directory.</p>';
            }

            echo '<div class="info">';
            echo '<p><strong>Current Directory:</strong> ' . htmlspecialchars($currentPath) . '</p>';
            echo '<p>Total Files: ' . $totalFiles . '</p>';
            echo '<p>Total Folders: ' . $totalFolders . '</p>';
            echo '<p>Total Size: ' . number_format($totalSize / 1024, 2) . ' KB</p>';
            echo '</div>';
            ?>

            <ul>
                <?php
                foreach ($files as $file) {
                    if ($file === '.' || $file === '..') {
                        continue;
                    }

                    $relativePath = str_replace($rootPath, '', $currentPath . DIRECTORY_SEPARATOR . $file);
                    $relativePath = ltrim($relativePath, DIRECTORY_SEPARATOR);

                    if (is_dir($currentPath . DIRECTORY_SEPARATOR . $file)) {
                        echo '<li><span class="icon folder">📁</span><a href="?path=' . urlencode($currentPath . DIRECTORY_SEPARATOR . $file) . '">' . htmlspecialchars($file) . '</a></li>';
                    } elseif ($file === $currentFile && realpath($currentPath) === $rootPath) {
                        echo '<li><span class="icon file">📄</span>' . htmlspecialchars($file) . ' <span class="currently-open">(currently open)</span></li>';
                    } else {
                        echo '<li><span class="icon file">📄</span><a href="http://php84.local:9000/' . htmlspecialchars($relativePath) . '">' . htmlspecialchars($file) . '</a></li>';
                    }
                }
                ?>
            </ul>
        </div>
        <footer>
            &copy; <?php echo date('Y'); ?> Danil Vilmont
        </footer>
    </div>
</body>
</html>
