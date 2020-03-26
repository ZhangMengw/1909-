<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016101800717625",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEAl7oOF0jqy9wEcUmZyJmZeJwaaetHeG1xbd5r0qaMi4SwjQJAZEpOWtukQvzBzlRPNX9E6dFpezubELlK+d9ebN1+EqZRNGq4kbNqxZEBYKOJADt77aP9k6A6tsrkX3OhKIrZ/NcKZARNVmZQdhF8BmtU34OyoVzmNohwy3diDlzTZF2QbpXD8nzsy9G06dzvA0O2sekn81TEUPeVfrKA2USLQTSLNXIlO35r/gZMV/RdO6rVMTh4YoFzNY8fM+jG7bX3xHOcrAGXMcNFZY7EIQ40XtA5WP57BHUhOSb9ZBHaqdKu8a0ZZZEPkRWbz8fpCnNbXguXigBHoMmxajk3CQIDAQABAoIBAFNEGgORUrm57v41BB5gnSbhlGVYZ4qhlURUchvSpwLSOQnJmIjxdnrKWyUgDUQsZKPZSnp/IEIu/fR5m7nxaaKZE10sxRfdEZl0Oz5dS8I7PS5Rdrt96eWgY1h5lEcF8AWN3f+yC9PDwKWP1MxW4Betw5A+eEOx9e0rh6tBwyBZ2nDlmmQkIsI1GcS8ZIU0r1GJCHYzLlCgG89NS90rPaowcdNqAqhBGg0hPZSl9UPPlmlR9lmoGjzc0GoYtvW0YUoxzThOShUuHrl9wj0cgtyjTQRO5h64GmlxA3EjujkBrBrCKguPBNXG6pWWB1x9zhTj1L2+3Hl0EAnRwNxHEgECgYEA4yNXp8S3l81znqW25ZInGrNkTarV1A4S+5iQtNau85Tb51dY64gufE+6TxYjI/iJKvjmAfaVUgUxs5VcR3pJvqfUntaEiay8j40GRZ28xTc9j2RKJfrjrGb4z8HYrxjKcvb89e+m9MCshMJ/UQ3yUKB+BHMB/kbrhcsOAi4242ECgYEAqwGhn6aPuj4e31qThPp1RFEQ5LoQJkWHnwOWN5NzIAM1Z/CMwfRUmR4jC6cpOe1MsA4Q1Olc1zUS9AGtKYjTeCzq2MPUCbR8/a5qQ2wYNM0oT2WFBOgpHsBA0jK1yhivpRuxX5Ey4g7oU4phL61ekR7Lbq4ydBcpBKTK2tounKkCgYAXjbatQwz2xOtUbELHE5zSe//OvgRmdP8q7+sxlYGW6LzVBI3H/tszMOFVCiqitEclGaJgWb2qP7ejs71Z/ChhiO3Xes9Lp4n2KN2Zon3MxamwkOnPfnDVk+gBQ0zA+4Ui3tHkfvGFN+Wr7q9dLGEQU1Q+Cd8PCzOpMCFHwJsYgQKBgQCfd877rXycpi9uA+5LdLCEe8BwO56xwecd/19HBma2dKeJ/QWWHT4C59qwlDravRLlnshNdC1StziseR+8+s6RY/nBGKUUQ87HVq3bn+LW4nZzy+0GzWUDOy93lTh3dRvesXtv7lxv+Izo0sOcjWUBmaEF3sZIAg0LOo29FveeuQKBgAtUlMovPQoBUv1EsCmlILQthoVJUuDEzVtNfpHPSYgJISLLIvVuZgWf+B9VpRYs8UsoNX/dGw5kP6iJGbB0ZhLcQU6895pM8HlHcPBikrUS5kCkXVXsBpzNSfQdJ6/IE0V3nS9e86OGfn98lLOHkVRiUW43cNTLN+/I9AqpK6bo",
		
		//异步通知地址
		'notify_url' => "http://工程公网访问地址/alipay.trade.wap.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "http://localhost/laravel/alipay/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAlw/0nODOm3NTMhDFHdz311SWmCqQYJBRbhhAtohhzwC13SN9lPac9vfn6Z7K2ZAyxQUCARl8B1tQevRmdUTAcwdSShqewwFDtNr+ZQOM36C2Mg4/8SeLcbcIbQsZGr3qHD+t1QBFHOvKpZAr1lywVF0cMDGV8oql+02BX0gPqewqQB/1H1VC7vh+/63+zQ9pVJfTBMlmYQT+xqW/Gfimy9xUdeZ1dO7JsmSif0HM47mGy4jd1hmNLuYAXNpNoE+BzuFISNoFD3b+l/UjYTZaNM0y02auUA56GKez3rrDg5V6N8KMIR/HWbbZzi6gSMY/UqdApRwqFqoSLzXAJBT1BQIDAQAB",
		
	
);