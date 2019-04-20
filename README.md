# Kiwari Bot Webhook Sample with PHP

## Requirements

* [PHP 7](https://www.php.net/)
* [Composer](https://getcomposer.org/)
* [ngrok](https://ngrok.com/)
* [Kiwari Access Token](https://qisme.qiscus.com/app/kiwari-prod)

## How to run

* Clone this repository and install dependencies `composer.json`

```bash
$ git clone https://gitlab.playcourt.id/iskandarsuhaimi/sample-bot-kiwari.git
$ cd sample-bot-kiwari
$ composer install
$ composer dump-autoload -o
```

* Login to [Kiwari User Dashboard](https://qisme.qiscus.com/app/kiwari-prod)
* Create Access Token
* Copy and Paste to `Controller.php` class

* Run webhook server

```bash
$ php -S localhost:3000
```

* Tunneling your webhook server

```bash
$ ngrok http 3000
```

* Register your webhook url by copy your ngrok https url from CLI at [Kiwari User Dashboard Profile](https://qisme.qiscus.com/app/kiwari-prod)

* Enjoy!