//redpacket
;(function(){
    'use strict';
    var controller = function(){

    };
    controller.prototype = {
        init:function(){

            var self = this;
            self.bindEvent();
            self.submitForm();

        },
        //bind all element event,such as click, touchstart
        bindEvent:function(){
            var self = this;
            $('input').on('keyup', function(){
                self.formValidate();
            });
        },
        formValidate:function(){
            var self = this;
            var validate = true,
                inputName = $('.input-name'),
                inputMobile = $('.input-phone'),
                inputAddress = $('.input-address');

            if(!inputName.val()){
                //inputName.parent().parent().append("<div class='error'>姓名不能为空</div>");
                Common.errorMsg.add(inputName,'姓名不能为空');
                validate = false;
            }else{
                Common.errorMsg.remove(inputName,'');
            }

            if(!inputMobile.val()){
                Common.errorMsg.add(inputMobile,'手机号码不能为空');
                validate = false;
            }else{
                var reg=/^1\d{10}$/;
                if(!(reg.test(inputMobile.val()))){
                    validate = false;
                    Common.errorMsg.add(inputMobile,'手机号码格式错误');
                }else{
                    Common.errorMsg.remove(inputMobile,'');
                }
            }

            if(!inputAddress.val()){
                Common.errorMsg.add(inputAddress,'地址不能为空');
                validate = false;
            }else{
                Common.errorMsg.remove(inputAddress,'');
            }


            if(validate){
                return true;
            }
            return false;
        },
        submitForm:function(){
            var self = this;

            /*
             * Submit the Form
             */
            var btnSubmit = $('.btn-submit');
            var enableSubmit = true;
            btnSubmit.on('touchstart',function(e){
                e.preventDefault();
                if(self.formValidate()){
                    if(!enableSubmit) return;
                    enableSubmit = false;
                    //    start to get keycode
                    var inputName = $('.input-name').val(),
                        inputMobile = $('.input-phone').val(),
                        inputAddress = $('.input-address').val();

                    Api.submitInfo({
                        name:inputName,
                        mobile:inputMobile,
                        address:inputAddress
                    },function(data){
                        enableSubmit = true;
                        if(data.code == 1){
                            //alert('提交成功');
                            Common.alertBox.add('提交成功');
                            window.location.href = 'index.html';
                        }else{
                            Common.alertBox.add(data.msg);
                        }
                    });


                };
            });
        },



    };

    if (typeof define === 'function' && define.amd){
        // we have an AMD loader.
        define(function(){
            return controller;
        });
    }
    else {
        this.controller = controller;
    }


}).call(this);

window.addEventListener('load', function(){
    var form= new controller();
    form.init();
});