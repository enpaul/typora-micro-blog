# Changelog

## Version 1.2

**Search implementation**

* Added search functionality
  * Homepage table now has filtering option
  * In-theme styling of search bar
* Fixed minor layout issues with the datatable
* Added Javascript requirement warning
* Added API-like alternative to datatable
  * Alternative formatting in raw JSON, instead of HTML
  * Publicly accessible at `/get-posts/`
* Added homepage table tag linking
  * Clicking on a tag now searches the table for that tag

## Version 1.1

**Feature flush-out**

* Added mobile-friendly responsive CSS
  * About-page and content page have proper margins on mobile
  * Title and headers resize appropriately on mobile
  * Homepage logo image is hidden on mobile
  * The homepage table hides advanced info on mobile
* Added custom error pages
  * HTTP error pages in the style of the site
  * Htaccess and Web.config files to enable custom error pages
  * Requesting a nonexistent post now gives a 404 error
* Fixed bug on reading page with shortcut icon URL

## Version 1.0

**Initial Release**

* Three-page layout
  * Homepage with chronologically ordered table of posts
  * About page with project information and external links
  * Dynamically generated post display page
* Metadata management
  * Dynamic metadata loading
  * Database-free metadata storage and parsing
  * Twitter meta definitions generated dynamically
  * OpenGraph meta definitions generated dynamically
* Content management
  * Dynamic content loading
  * Database-free content storage and parsing
* Post browsing
  * Pagination
  * Automatic ordering from newest to oldest
  * Metadata integration
* Minimalist, dark theme for straightforward usage
* Optimized to work with HTML files exported from Typora Markdown Editor
