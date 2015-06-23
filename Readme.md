Analytic Service Installation
=============================
Overview:
----------
**Input Endpoint** 

that will allow to save events in AS. Url pointing to this endpoint should accept
following arguments: eventNameand eventValue.

For example:

   `http://url.to.service/?endpoint=input&eventName=bar&eventValue=foo`

After receiving a request to Input Endpoint, Analytics Service should store event in database
together with referrer url and date and time. Response of this endpoint should be transparent
1x1 image that can be used in any way we want.

**Dashboard Endpoint**

This endpoint should provide analytics view of stored event as table and/or chart 
Dashboard should allow user to:

- group events by name
- group events by date

That means that user should be able to see number of events grouped name and/or by date in a
form of table or chart.

Download
--------

Download or checkout (SVN/Git) from https://github.com/safaa-alnablsi/analyticService.git and unpack file in your server public folder

Git clone
---------

    git clone  git@github.com:safaa-alnablsi/analyticService.git


Configure && Run
------------------
1. Download [Yii Framework](https://github.com/yiisoft/yii/releases/download/1.1.16/yii-1.1.16.bca042.zip), unpack it to your server, if you are using WAMP server for example, you put it: `C:\wamp\www\yii` and you change the folder name to `yii`.
2. Put the project in the public folder in your server  `C:\wamp\www\AnalyticsService`.
3. Import the database in the folder `/data/analytics_service.sql`
4. Go to your browser : `http://localhost/AnalyticsService/`
5. Login with one of these three credentials:

        admin/admin
        demo/demo

6. Congrats! you are logged in!

What's Now?
------------------
 - You can see in the Home page a url. you can open it in a new tab and start adding new events by changing the name and the
   value, for example :
      - You will get a success image as a response or the following urla:
         - `http://localhost/AnalyticsService/endpoint/input?eventName=bar&eventValue=foo`
         - `http://localhost/AnalyticsService/endpoint/input?eventName=bar&eventValue=momo`
         - `http://localhost/AnalyticsService/endpoint/input?eventName=lar&eventValue=toto`
         
      - and You will get an error image as a response
         - `http://localhost/AnalyticsService/endpoint/input?eventName=bar&eventlue=foo`
         
      - **Note:** you can add authentication on this action so only a user with a right to access this can do the action
         you have to assign the user this permission from Rights, and uncomment the hinted code in `Controllers/EndpointController/actionInput`
 - user management :  
  
          add/update/delete/list all users in the system as admin
          login/logout/change password/update as a user

 - play with roles/permissions in Rights, you can handle every single task and operation in your system.


Used Technologies
---------------------
1. Yii Framework: http://www.yiiframework.com/
2. user: http://www.yiiframework.com/extension/yii-user/
3. rights: http://www.yiiframework.com/extension/rights/
4. chartjs : http://www.yiiframework.com/extension/yii-chartjs/
