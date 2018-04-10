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
