# Extr

A simple micro-framework PHP.

## Create a new Controller

 - Create a new file in the directory: "**src/Controllers/**".
 - The file must have the suffix "**Controller**": Users**Controller**.
 - And should extend the **Controller** class.

### Exemple:

    <?php
    
    namespace Extr\Controllers;
    
    use Extr\Core\Controller;
    
    class UsersController extends Controller
    {
        public function index()
        {
            $this->setData([
                'viewData' => 'Data for use in the view'
            ]);
    
            $this->loadView('users/index');
        }
    }

## Instaled Helpers

 - Twig for template engine ([documentation](https://twig.symfony.com/))
 - CSRF Token
 - Flash Messages ([documentation](https://packagist.org/packages/plasticbrain/php-flash-messages))
 - Generic PDO Model

## Use CSRF Token

Add in your form: **{{ form_token() }}**

    <form method="POST" action="#">
      
      {{ form_token() }}
      
      <input type="text" name="name">
      <input type="submit" value="Send">
    </form>

## Use Flash Messages

Add messages in your Controller Methods:

    $this->msg->info('This is an info message');
    $this->msg->success('This is a success message');
    $this->msg->warning('This is a warning message');
    $this->msg->error('This is an error message');
    $this->msg->error('This is an error message', 'http://your-redirect-link.com');

Add in your views: **{{ flash_messages() }}** for display the messages.

    ...
    <body>
      {{ flash_messages() }}
    </body>
    ...

## New features in development

...

## License

The MIT License (MIT)

Copyright (c) 2018 [Valdinei Reis](http://valdineireis.com.br/)

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
