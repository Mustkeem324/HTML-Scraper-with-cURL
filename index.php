<?php
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['url'])) {
        $text = $_GET['url'];
        $url = $text;
        echo $url;
        if (strpos($url, 'wegglab.com') !== false) {
            $curl = curl_init();
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                'authority: wegglab.com',
                'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.7',
                'accept-language: en-US,en;q=0.9',
                'cache-control: max-age=0',
                'dnt: 1',
                'referer: https://wegglab.com',
                'sec-ch-ua: "Chromium";v="118", "Google Chrome";v="118", "Not=A?Brand";v="99"',
                'sec-ch-ua-mobile: ?0',
                'sec-ch-ua-platform: "Linux"',
                'sec-fetch-dest: document',
                'sec-fetch-mode: navigate',
                'sec-fetch-site: same-origin',
                'sec-fetch-user: ?1',
                'user-agent: Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/118.0.0.0 Safari/537.36'
                ),
            ));
            $response = curl_exec($curl);
            if ($response === false) {
                echo 'cURL error: ' . curl_error($curl);
                exit;
            }
            curl_close($curl);
            if (strpos($response, 'entry-content clear') !== false) {
                $folderPath = 'wegglabhtml';
                $filename = md5($url) . '.html'; // Use the URL as a unique identifier for the response file
                $filePath = __DIR__ . '/' . $folderPath . '/' . $filename;
                
                // Check if the folder exists or create it
                if (!is_dir($folderPath)) {
                    mkdir($folderPath, 0755, true); // 0755 is a common permission setting
                }
                if (file_exists($filePath)) {
                    $htmlContent = file_get_contents($filePath);
                } else {
                    $modifiedResponse = str_replace('<div id="payment-wrapper">', '<div id="payment-wrapper" style="opacity: 0;">', $response);
                    $modifiedResponse = str_replace('.lockedAnswer', '<div class="ali" itemprop="text">', $modifiedResponse);
                    file_put_contents($filePath, $modifiedResponse);
                    $htmlContent = $modifiedResponse;
                }
                echo $htmlContent;
            }
        }
    } else {
        echo "URL parameter is missing.";
    }
} else {
    echo "URL parameter is missing.";
}
?>
