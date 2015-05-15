DUMMY API
========

POST /web/orders

Puts the action of creating a order in a queue, should return a reference in this format:
 
```
{"id":"1601e1c0-7e7a-4ba9-bea4-5b70b955bfff"}
```

The data posted is in this format:

``` 
{  
   "order":{  
      "id":"A123456",
      "customerId":"2143124",
      "lines":[  
         {  
            "sku":"XSJK-23",
            "quantity":1,
            "price":"999.00"
         },
         {  
            "sku":"KHGJ-12",
            "quantity":1,
            "price":"249.00"
         }
      ],
      "currency":"NOK",
      "country":"NO"
   }
}
```
This method gives an error if:

- data posted is not JSON or blank
- id is blank
- lines is empty
- currency has length different than 3
- country has length different than 3
- customerId is not numeric

GET /web/orders/order-id

Returns an order in this format:

```
{  
   "order":{  
      "id":"order-id",
      "customerId":"2143124",
      "lines":[  
         {  
            "sku":"XSJK-23",
            "quantity":1,
            "price":"999.00"
         },
         {  
            "sku":"KHGJ-12",
            "quantity":1,
            "price":"249.00"
         }
      ],
      "currency":"NOK",
      "country":"NO"
   }
}
```

NOTE: for the purpose of testing all order starting with letter A will exist, and others don't.