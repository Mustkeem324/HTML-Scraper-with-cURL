# HTML Scraper with cURL

This PHP script is designed to scrape HTML content from a specified URL using cURL. It checks if the URL parameter is provided via a GET request, then retrieves the content from the URL if it matches a predefined domain (`wegglab.com` in this case). If the content contains a specific marker (`entry-content clear`), it saves the HTML content to a file in a designated folder (`wegglabhtml`) for future reference.

## Usage

1. Ensure you have PHP installed on your server.
2. Place the `html_scraper.php` file in your server's directory accessible via a web server.
3. Access the script via a web browser or make a GET request to the script with the `url` parameter containing the URL of the webpage you want to scrape.

Example usage:

```
http://example.com/html_scraper.php?url=https://wegglab.com/sample-page
```

## Dependencies

- cURL extension for PHP

## Configuration

- Ensure that the server has write permissions to the `wegglabhtml` directory for storing scraped HTML content.

## Disclaimer

This script is provided as-is without any warranties. Use it responsibly and respect the terms of service of the websites you are scraping.
