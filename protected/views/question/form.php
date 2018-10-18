


<div class="page" id="form">
    <div class="con">
        <div class="frameBg">
            <img src="/vstyle/imgs/question/bg_t.png" width="100%" />
            <div class="frameBg_con">

                <div class="form_con">
                    <img src="/vstyle/imgs/question/form_title.png" width="100%" />
                    <ul>
                        <li>
                            <label for="name">真实姓名：<input type="text" name="name"></label>
                        </li>
                        <li>
                            <label for="tel">联系电话：<input type="tel" name="tel"></label>
                        </li>
                        <li>
                            <label for="adress">寄送地址：<input type="text" name="adress"></label>
                        </li>
                    </ul>

                </div>

            </div>
            <img src="/vstyle/imgs/question/bg_b.png" width="100%" />
        </div>
    </div>
</div>

<div class="footer">
    <a href="javascript:;" class="confirmSubmit"></a>
    <img src="/vstyle/imgs/question/footer_submit.png" width="100%" />
</div>

<script type="text/javascript">

    function GetQueryString(name){
    var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
    var r = window.location.search.substr(1).match(reg);
    if(r!=null)return unescape(r[2]); return null;
    }

    var lotteryCode = GetQueryString("code");


    function isPhoneNum(value){
      return /^0|^((\+?86 )|(\(\+86 \)))?(13[0-9]|15[012356789]|18[012356789]|14[57])[0-9]{8}$/.test(value);
    };

    function isTellNum(value){
      return /([0-9]{3,4}-)?[0-9]{7,8}/.test(value);
    };

    function checkForm(){
        var q_name = $("input[name='name']").val();
        var q_tel = $("input[name='tel']").val();
        var q_adress = $("input[name='adress']").val();

        if(q_name == "" || !q_name){
            formErrorTips("真实姓名不能为空！");
            $(".confirmSubmit").removeClass("disabled");
        }else if(!isPhoneNum(q_tel) || !isTellNum(q_tel)){
            formErrorTips("联系方式填写有误！");
            $(".confirmSubmit").removeClass("disabled");
        }else if(q_adress == "" || !q_adress){
            formErrorTips("寄送地址不能为空！");
            $(".confirmSubmit").removeClass("disabled");
        }else{
            formInterface(q_name, q_tel, q_adress);
            $(".loading").show();
        }
    }



    function formInterface(name, tel, adress){
        $.ajax({
            type: "POST",
            url: "/api/question/action/luckierinfo",
            data: {
                "sessionid":lotteryCode,
                "user": name,
                "telphone": tel,
                "address": adress
            },
            dataType:"json"
        }).done(function(data){
            if(data == "12"){
                window.location.href = "/question/success";
                //alert("提交成功");
            }else if(data == "11"){
                formErrorTips("数据格式错误");
            }else if(data == "13"){
                 formErrorTips("提交错误");
            }else if(data == "14"){
                  formErrorTips("未能查询到中奖 信息");
            }else{
            }

            $(".loading").hide();
            $(".confirmSubmit").removeClass("disabled");
        }).fail(function(){
            formErrorTips("很抱歉，提交失败，请刷新之后重新提交！");
            $(".loading").hide();
            $(".confirmSubmit").removeClass("disabled");
        })
    }


    $(".confirmSubmit").click(function(){
        if(!$(this).hasClass("disabled")){
            $(this).addClass("disabled");
            checkForm();
        }
    })


    var alertInt;
    function formErrorTips(alertNodeContext){
        clearTimeout(alertInt);
        if($(".alertNode").length > 0){
            $(".alertNode").html(alertNodeContext);
        }else{
            var alertNode = document.createElement("div");
                alertNode.setAttribute("class","alertNode");
                alertNode.innerHTML = alertNodeContext;
                document.body.appendChild(alertNode);

        }
        alertInt = setTimeout(function(){
            $(".alertNode").remove();
        },3000);
    }



</script>