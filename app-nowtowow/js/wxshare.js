$(document).ready(function(){
    function weixinshare(obj){
        $.ajax({
            url:'/weixin/jssdk',
            type:'GET',
            data:{url:window.location.href},
            dataType:'json',
            success:function(result){
                var wxdata = result;
                wx.config({
                    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                    appId: wxdata.appid, // 必填，公众号的唯一标识
                    timestamp: wxdata.time, // 必填，生成签名的时间戳
                    nonceStr: wxdata.noncestr, // 必填，生成签名的随机串
                    signature: wxdata.sign,// 必填，签名，见附录1
                    jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage','onMenuShareQQ'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2
                });
                wx.ready(function(){
                    wx.onMenuShareAppMessage({
                        title: obj.title1,
                        desc: obj.des,
                        link: obj.link,
                        imgUrl: obj.img,
                        type: '',
                        dataUrl: '',
                        success: function () {
                            console.log('share success to friend');

                        },
                        cancel: function () {

                        }
                    });
                    wx.onMenuShareTimeline({
                        title: obj.title1,
                        link: obj.link,
                        imgUrl: obj.img,
                        success: function () {
                            console.log('share success to timeline');
                        },
                        cancel: function () {

                        }
                    });
                    wx.onMenuShareQQ({
                        title: obj.title1, // 分享标题
                        desc: obj.des, // 分享描述
                        link: obj.link, // 分享链接
                        imgUrl: obj.img, // 分享图标
                        success: function () {
                            // 用户确认分享后执行的回调函数
                        },
                        cancel: function () {
                            // 用户取消分享后执行的回调函数
                        }
                    });


                })
            }
        });

    };

    weixinshare({
        title1:'贝玲妃全新眉法眉天系列 新品上市!',
        des:'贝玲妃全新眉法眉天系列 新品上市!',
        link:window.location.href,
        img:'http://benefit.samesamechina.com/app-nowtowow/images/share.jpg'
    });


});