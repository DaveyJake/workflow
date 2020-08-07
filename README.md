# My standard project files and settings.

Installation Steps In Order
---------------------------

### 1. Requirements

To add to the development of this theme, please install the following:

- [Node.js](https://nodejs.org/)
- [Composer](https://getcomposer.org/)
- [Gulp.js](https://gulpjs.com/) (install globally* using `npm install -g gulp`)

###### * Optional but recommended


### 2. Local Quick Start

Clone this repository to your local environment and create a new branch describing a feature (like, say, `search-result-tiles`).


### 3. Setup Theme Environment

To start developing on this theme, you'll need to install the necessary Node.js and Composer dependencies.

Open your CLI (e.g. [`iTerm2`](https://www.iterm2.com/) ; [`PuTTY`](https://www.chiark.greenend.org.uk/~sgtatham/putty/) **⊞**; [`Terminal`](https://support.apple.com/en-in/guide/terminal/welcome/mac); [`Command Prompt`](https://docs.microsoft.com/en-us/windows-server/administration/windows-commands/cmd)) and go your project directory (i.e. `cd /path/to/your/project`).

Run the following commands:

```sh
$ composer install
$ npm install
```


### 4. Local Theme Configuration

To override the default theme configs found in `config-default.yml`, simply copy those options into a new file named `config.yml`.  You configs will override the theme's and will not be uploaded to Github.

### Available CLI commands

`Project` comes packed with CLI commands tailored for WordPress theme development :

- `composer run-script lint:wpcs` : checks all PHP files against [PHP Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/php/).
- `composer run-script lint:php` : checks all PHP files for syntax errors.
- `composer make-pot` : generates a .pot file in the `language/` directory.
- `npm start` : watches all files and recompiles them when they change.
- `npm run lint:scss` : checks all SASS files against [CSS Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/css/).
- `npm run lint:js` : checks all JavaScript files against [JavaScript Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/javascript/).
- `npm run package` : bundles theme together for installation (as a `.zip`).

### Changelog

* DATE_OF_CREATION: Initial commit.
