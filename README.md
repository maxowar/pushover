# PHP Pushover API

Simple API to send notifications to your smartphone via Pushover service.

Follow the instruction on the official website to sign up and obtain a USER KEY and a TOKEN for your application client.

## How to use it

It's very simple.

From your application code.

```
$pushover = new Pushover(new Configuration(YOUR_TOKEN, YOUR_USER));

$pushover->send(new Message("Hello Pushover"));
```

### Console

You can the API even from the console

In order to use it you have to run the installation command that allow you to save your TOKEN and USER

```
# pushover pushover:install
```

Now you can use it
 
```
# pushover message:push -m "Hello Pushover"
```

## Resources

Through the Pushover object you can obtain oject of type Api to make the requests to the
 various resources offered by Pushover REST API.

### Message API

With that you can send objects of type Message.

```
$message = new Message("text message");
$message->setTitle("Title");
```

The only noticeable method offered by the interface is the method push() 

```
$messageApi = $pushover->getMessageApi();
$messageApi->push($message);

```

### Group API

