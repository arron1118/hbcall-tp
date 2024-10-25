<?php

use Yansongda\Pay\Pay;

return [
    'alipay' => [
        'web' => [
            // 必填-支付宝分配的 app_id
            'app_id' => '2021004189691334',
            // 必填-应用私钥 字符串或路径
            // 在 https://open.alipay.com/develop/manage 《应用详情->开发设置->接口加签方式》中设置
            'app_secret_cert' => 'MIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQCznwrHfphj6pdC0ux00qXH2gyHAqKZ7W7HzUQdNb+Glz4pwzedm+Rq3vqh3Fyz7AAHXfpx+dA9pfpuHuGEZM4iSoCHb+kVlQ5FPwT6gw/aNBZAcgnxafK3NF344OvbXOnWAcodM46jwFyWT/wQF8DjbJ0f2cghFBBmhrnXRQ0XGiLwdxwS6d8KMq4O3AImBSyCZrTJMmKTnD0p7fEe+elQ3UyN33jFZDhEp2CPgnew/w2PKxWxyhfLBZv9DIMNw07BzxnwHMQehkzeT3oj9U+LjYKsZgjlzeWPoj/7LaWp9IyY2WtWkb5fvpKjSuFDNm2y6rwPtcAMT7fd59EM+sZZAgMBAAECggEAahKr3O+nsqmgtfe1Z6/V8tWTvE8UEu6iEx/m75EED8lVDniYaVzcYThYriliHWZrBe67rX8nOKDB6TIXX4XgLWPtzw2JihNCICZ9HCs1u1gzI8+0i3pTuVkVfZnl7t9Jv/XCk8gUniNFCgcmBaLhZ+yGRX7orpAYt1MsgDHo7xCkE0aiOckGzG/yqN+WWRo9R3XdSslN53QEbaO6EozCpa80jU/1iPsmeQel6PRVFMSFkC1cN1gYzsYh6CN6vtH5YAXNGxDJnK/57DUs2IZH+3H8h/xnhGIhI8RQFFzyMIFINlun02mYLtBIkvbgw9lq9p6TqB2V9y+UsGVyIyVY4QKBgQDpPrpKQEsyxNTMfVh+UWfgLCXHMtaMgN/jEj1zyHYQvl58ShV1G1dBsRbI26SeRV4z6FoZvnsRON53m15dlvq4DX2Cs38XbrJMLqDvOy6rda8djah20SAJKwi7RkUyVZcoO/ZISCT1pBkrXxx3zquVGKwjhVlVW+RAogePcSdvRQKBgQDFJRDa+YFyEM1DtgnFXSZq0bcMJIesbCBn5JjMP7PEjarrHekICXSr1Gn7uawzFM6fEVUdoKZndNtmYXWcmuGrjcLCh8/ZSUcDm9Si0Qxh5q4YUwDU5Y8KMYZnMAoaJ4+KHyJArtIYwRfu827u12PyVU9KFhE78ehkCdDC4aPSBQKBgQDZR4kNAGXM7pV5xU65paYJq7apoU9CZg+qnWRHxrdNk7m7ONxSUlzvokOiaxIoKmC+JDZDAzHr8jkz3LWEo8/9wvtn1USQlJtd4pYjJdOtAB1Yf40u2lNolwE0TBrL7/W3Ely0KxjbB7o2sAx6AznN08UP9fopTUgNeaNnWbatrQKBgQC8eCP2A4ORxahGbDhJGzVH93dUP3QJDVGpoOvGj7vPU1Qr8+s8yLVmM+qiQS3zo5eokExbx6Jt01SQOunSLmtBs4OWr3mwE5K1S3trsAhza7HSBUANR+yIZTJFYbK2sE1UUVFQnxCxo5+6y7So1vdwy8fCXvhY43o0cQHH3Sjc9QKBgCFQbOPiMJ+eUWlz/DLP7nzSzFLs0AW2LNQJoxhnz1OVUU6NxtMYAwiEksu7PvwHgY845JcWCEaPY/npkj9RYlOMXb9yF+F+i5gZk3NB9VB/tFMJX/rMdwDzdoWIQHMo0kL8vgeBnfAcsrJX7sW3c1jfVgDHVL/ZAsqGUy9dzOiK',
            // 必填-应用公钥证书 路径
            // 设置应用私钥后，即可下载得到以下3个证书
            'app_public_cert_path' => app()->getConfigPath() . './certs/appCertPublicKey_2021004189691334.crt',
            // 必填-支付宝公钥证书 路径
            'alipay_public_cert_path' => app()->getConfigPath() . './certs/alipayCertPublicKey_RSA2.crt',
            // 必填-支付宝根证书 路径
            'alipay_root_cert_path' => app()->getConfigPath() . './certs/alipayRootCert.crt',
            'return_url' => 'http://caller.hbosw.com/company/payment/alipayResult',
            'notify_url' => 'http://caller.hbosw.com/api/payment/alipayNotify',
            // 选填-第三方应用授权token
            'app_auth_token' => '',
            // 选填-服务商模式下的服务商 id，当 mode 为 Pay::MODE_SERVICE 时使用该参数
            'service_provider_id' => '',
            // 选填-默认为正常模式。可选为： MODE_NORMAL, MODE_SANDBOX, MODE_SERVICE
            'mode' => Pay::MODE_NORMAL,
        ],
        'app' => [
            // 必填-支付宝分配的 app_id
            'app_id' => '2021003124678557',
            // 必填-应用私钥 字符串或路径
            // 在 https://open.alipay.com/develop/manage 《应用详情->开发设置->接口加签方式》中设置
            'app_secret_cert' => 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQCmxzV+2/x9noGkESFZxlElTsMbcmrPWjBeC3DTHNOoNNr5yQureIElh1OVd6NVS+65h7WEQssCi8wynWMTlm68J0MykTFAsUrV4C9Z191LeQ6/8cvY2Gk7s+zkEYZWvqNGyOxqeqIEMXmIyCEB7cMtJETp479vpqubO+F1KPeF1TDRB72MtLGCmVmDXTrLp9hBTN6TfBBI2DRTZHBeB3Cw4xofsKFvn7v+Ee/4v6NjoIm3ksCqT3cSAMOTDCueE324d3iaE3p2Q8tDxlzljRuu0n+quiTLs8AkZsf5tiLzwcfUU+DNZs4bXPIeK2sNzs8Gm1SbWQg08uPXHXO1SwlJAgMBAAECggEBAJBIPQ6P0GL40t0WeMzK1f65oe9H0AGs27Uwnp31DWMyvtJjzLW+XbQS3Aut4d7z/wYA0tcmVazRNon/QOx8MzaRnP/NPlfiSYS4Gx7VsjwN8eW6kIj7yCZ/ZQx14MuAx46AWo9PooSQLL1ZrbyWbkjKXNgfUMmN3l5Asq8CDwl22quW2taBEgnnz8TmX6eeTh7biIUXisaSggpqQCvj6nzUCORTwpPDwElAlBswkuwZcnJtTdyZ6TWo+VYflVBfI8G5+F4Z4SVu7H/vsvbibpAxTYOi1s5FkcPl5VwFd4NJa+gNCRVu1y4eYli6w9jX3d4UsbQbcQgKvvb1DAiL0XUCgYEA7HOfS5GW3Xjdw+K4A9qUoNkNZIGEFZRrF60N6MTxDmAiarUBg03YzfKkNVKIz8NrHTYFJjiHuHyqXwfA7puU9N34cKBBwqd0cnwNm5b0Uqo9QCiq914SDufKoFIgg3LHWzOhoLpxPZr5PSfhTdSHmFyNIKHkoNHkJrQ4wcuvHo8CgYEAtJD7q+Hy9CaDdQY7nnLpIrsy5UywX3UFptRmrGofx03iFeyjcj5pQtz8TzXeHrTfi9VTSIVCjhiikJAKLlAYcdS487z/eWbFCxiki55IyXCEAp/9ORBBRPkU7C9V7J7cPTheHg3gHB38jMIIxGNrjIRgu75oi9YSDY7zp2qdRqcCgYBJaey/jciFow1X0IDJ0YfsGPgriHr2KErH4xc6ektN51NIRkLd/cGe0ANj+ug3ebk8LJWUtGCPS0Wqk8G3U97/2BtW/KruQQfKs/GVqVzafbjevsG2ZCK/NgCXnmgx5+U1z+YS/VBDjGZuMn+lpqMjDzlSNHHD7OcljTdCFHeeyQKBgAY2guJcKO7rsFRDfaOrEoiGZm7rX5o5PZOK9WlzUVqbPG9CsDELIrYRQoE7OkRWNubp1S7Gnw6inF1bB26mhODNz/tbAnNb7OW/2FGRhbGgtHoepSjkfUpxQ54I1u0IXk2g9eQU2CQ/h+QT/Rc80IOKPoXXPGOrXv2mcI3PJlA7AoGACn9eVI4pbaio7gmm6deLhlz3FBpD0ireHMY29NAh1DNEnJZqxD75c0viV1BIRFSsMhcVr+c8nOKmvlRe+u9k4kBDFlNdHvMW+IIuLC2d1cCts7QiScB+1RY7v/OHsOwWMojqWpxLXYdkZsWvlS3+t+m666NJxW+hpSRlWbj3ZEA=',
            // 必填-应用公钥证书 路径
            // 设置应用私钥后，即可下载得到以下3个证书
            'app_public_cert_path' => '/Users/yansongda/pay/cert/appCertPublicKey_2016082000295641.crt',
            // 必填-支付宝公钥证书 路径
            'alipay_public_cert_path' => '/Users/yansongda/pay/cert/alipayCertPublicKey_RSA2.crt',
            // 必填-支付宝根证书 路径
            'alipay_root_cert_path' => '/Users/yansongda/pay/cert/alipayRootCert.crt',
            'return_url' => 'http://caller.hbosw.com/company/payment/alipayResult',
            'notify_url' => 'http://caller.hbosw.com/api/payment/alipayNotify',
            // 选填-第三方应用授权token
            'app_auth_token' => '',
            // 选填-服务商模式下的服务商 id，当 mode 为 Pay::MODE_SERVICE 时使用该参数
            'service_provider_id' => '',
            // 选填-默认为正常模式。可选为： MODE_NORMAL, MODE_SANDBOX, MODE_SERVICE
            'mode' => Pay::MODE_NORMAL,
        ],
    ],
    'wechat' => [
        'default' => [
            // 必填-商户号，服务商模式下为服务商商户号
            // 可在 https://pay.weixin.qq.com/ 账户中心->商户信息 查看
            'mch_id' => '1695646480',
            // 选填-v2商户私钥
            'mch_secret_key_v2' => 'ECPbogadOBXvGzwp9klS9P3L7z3HE5IG',
            // 必填-v3 商户秘钥
            // 即 API v3 密钥(32字节，形如md5值)，可在 账户中心->API安全 中设置
            'mch_secret_key' => 'Axcv2M0CiOeLynN0n4ylyBteBm0n5cAF',
            // 必填-商户私钥 字符串或路径
            // 即 API证书 PRIVATE KEY，可在 账户中心->API安全->申请API证书 里获得
            // 文件名形如：apiclient_key.pem
            'mch_secret_cert' => app()->getConfigPath() . '/certs/apiclient_key.pem',
            // 必填-商户公钥证书路径
            // 即 API证书 CERTIFICATE，可在 账户中心->API安全->申请API证书 里获得
            // 文件名形如：apiclient_cert.pem
            'mch_public_cert_path' => app()->getConfigPath() . '/certs/apiclient_cert.pem',
            // 必填-微信回调url
            // 不能有参数，如?号，空格等，否则会无法正确回调
            'notify_url' => 'http://caller.hbosw.com/api/payment/notify',
            // 选填-公众号 的 app_id
            // 可在 mp.weixin.qq.com 设置与开发->基本配置->开发者ID(AppID) 查看
            'mp_app_id' => 'ww01beae8f33a202b4',
            // 选填-小程序 的 app_id
            'mini_app_id' => '',
            // 选填-app 的 app_id
            'app_id' => 'ww01beae8f33a202b4',
            // 选填-服务商模式下，子公众号 的 app_id
            'sub_mp_app_id' => '',
            // 选填-服务商模式下，子 app 的 app_id
            'sub_app_id' => '',
            // 选填-服务商模式下，子小程序 的 app_id
            'sub_mini_app_id' => '',
            // 选填-服务商模式下，子商户id
            'sub_mch_id' => '',
            // 选填-微信平台公钥证书路径, optional，强烈建议 php-fpm 模式下配置此参数
            'wechat_public_cert_path' => [
                '45F59D4DABF31918AFCEC556D5D2C6E376675D57' => __DIR__.'/Cert/wechatPublicKey.crt',
            ],
            // 选填-默认为正常模式。可选为： MODE_NORMAL, MODE_SERVICE
            'mode' => Pay::MODE_NORMAL,
        ]
    ],
    'unipay' => [
        'default' => [
            // 必填-商户号
            'mch_id' => '777290058167151',
            // 选填-商户密钥：为银联条码支付综合前置平台配置：https://up.95516.com/open/openapi?code=unionpay
            'mch_secret_key' => '979da4cfccbae7923641daa5dd7047c2',
            // 必填-商户公私钥
            'mch_cert_path' => __DIR__.'/Cert/unipayAppCert.pfx',
            // 必填-商户公私钥密码
            'mch_cert_password' => '000000',
            // 必填-银联公钥证书路径
            'unipay_public_cert_path' => __DIR__.'/Cert/unipayCertPublicKey.cer',
            // 必填
            'return_url' => 'https://yansongda.cn/unipay/return',
            // 必填
            'notify_url' => 'https://yansongda.cn/unipay/notify',
            'mode' => Pay::MODE_NORMAL,
        ],
    ],
    'logger' => [
        'enable' => true,
        'file' => app()->getRuntimePath() . 'logs/pay.log',
        'level' => 'info', // 建议生产环境等级调整为 info，开发环境为 debug
        'type' => 'single', // optional, 可选 daily.
        'max_file' => 30, // optional, 当 type 为 daily 时有效，默认 30 天
    ],
    'http' => [ // optional
        'timeout' => 5.0,
        'connect_timeout' => 5.0,
        // 更多配置项请参考 [Guzzle](https://guzzle-cn.readthedocs.io/zh_CN/latest/request-options.html)
    ],
];

