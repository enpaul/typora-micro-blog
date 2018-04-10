# Post Creation Documentation

This document describes how to create posts using the Typora Markdown Editor.

Each post is comprised of two files, `content.html` and `meta.json`, stored in a uniquely named directory under `/data`. A demo file of each is contained in this directory.

## Creating a Content File Using Typora

1. Within Typora, click `file > export > HTML`
2. In the `/data` directory create a new directory with a name descriptive of the post; usually the title
3. Save the file as `content.html`

The exported file will have a whole lot of extra stuff in it, including the header and all the needed CSS. This will be stripped out by the parser and the global CSS file and HTML header will be used instead.

**NOTE:** currently this format does not support images in posts. The links will break when viewed via the website.

## Creating a Content File without Typora

**NOTE:** currently this feature is not supported

1. Create a new empty text file in your editor of choice
2. In the empty file create a body tag pair, `<body>` and `</body>`
3. Within this body tag, insert your content, formatted like normal HTML
4. In the `/data` directory create a new directory with a name descriptive of the post; usually the title
5. Save the file as `content.html`

**NOTE:** some HTML elements may not be styled correctly due to missing Typora export classes and ID's

## JSON Metadata File

Every post directory under `/data` must include a `meta.json` file. If it does not, it will not be recognized as a post by the parser. To create a new metadata file, it is recommended that you copy the demo file in this directory and modify it.

| Index | Usage |
| ----- | ----- |
| `[title]` | Title of the post |
| `[description]` | *Not used* |
| `[author][name]` | *Not used* |
| `[author][email]` | *Not used* |
| `[author][social][url]` | Contact URL or social media account |
| `[author][social][handle]` | Contact handle or identifier |
| `[timestamp][published]` | *Not used* |
| `[timestamp][update]` | Determines order of listing for the post |
| `[words]` | Word count of the post |
| `[slug]` | Unique identifier, **must match the post directory name** |
| `[tags]` | *Not used* |

## Changing the theme

You will need [Typora](https://typora.io#download) and the theme you want to use for the blog, from the [Typora Theme Gallery](http://theme.typora.io).

1. Follow [the instructions to install a new theme in Typora](http://theme.typora.io/doc/Install-Theme/)
2. Open Typora, and set the active theme to be the one you want to use for the site
3. Click `Help > Markdown Reference`
4. Click `File > Export > HTML` and save the file somewhere
5. Open the exported HTML file in your text editor of choice
6. Towards the top of the document is a `<style>` tag with lots of CSS; copy the contents of the style tag into a new file
7. Save the file as `typora.css`
8. Replace the existing file `/css/typora.css` in this repository with the file you just saved

**NOTE:** You may need to make some modifications to `style.css` if there are readability problems with the new theme
