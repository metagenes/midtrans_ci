# REST API Documentation

This is REST API using CodeIgniter and Midtrans for PHP. 

## Clone 

    git clone https://github.com/metagenes/midtrans_ci

Save to your local server such as XAMPP in htdocs folder.

## Install

    composer install

## Run the app

    http://localhost/midtrans_ci/index.php/product


# REST API

The REST API to the app is described below.

## Get list of Things

### Request

`GET /`

    curl -i -H 'Accept: application/json'  http://localhost/midtrans_ci/index.php/product

### Response

    HTTP/1.1 200 OK
    Date: Thu, 24 Feb 2011 12:36:30 GMT
    Status: 200 OK
    Connection: close
    Content-Type: application/json
    Content-Length: 2

    [welcome to checkout API, for API documentation please refer to ...]

## Create a new Thing

### Request

`POST /product`

    curl -i -H 'Accept: application/json' -d 'customer_name=Name&customer_email=Email&customer_phone=123&product_description=description&total_price=total_price' http://localhost/midtrans_ci/index.php/product

### Response

    HTTP/1.1 201 Created
    Date: Thu, 24 Feb 2011 12:36:30 GMT
    Status: 201 Created
    Connection: close
    Content-Type: application/json
    Location: /thing/1
    Content-Length: 36t

    {"snapToken"}

