var anwser = {
    "1":["23岁以下","23-30岁&nbsp;&nbsp;","30-40岁&nbsp;&nbsp;","40岁以上"],
    "2":["基本每天都化","每周2-4次","有特别需要才化妆，<br />每月不超过5次","基本不化妆"],
    "3":["100以下","100-500","500以上"],
    "4":["没有经验","初学者","中级水平","专业级达人"],
    "5":["清新自然","性感魅惑","优雅成熟","俏皮可爱","新奇好玩"],
    "6":["粉底液","粉饼","粉底霜","BB霜","遮瑕棒"],
    "7":["基本每天都化","每周2-4次","有特别需要才化妆，<br />每月不超过5次","基本不化妆"],
    "8":["粉底液","粉饼","粉底霜","BB霜","遮瑕棒"],
    "9":["贝玲妃","迪 奥","雅诗兰黛","兰蔻","香奈儿","乔治·阿玛尼","其 他"],
    "10":["价 格","包 装","品 牌","功 效"],
    "11":["遮瑕力","粉 质","色 号","持妆力","保湿度","含护肤成分","控 油","光泽度","轻薄度","防晒指数"],
    "12":["遮瑕力强","持久度高","无妆感","控 油","轻 薄","自 然","保湿度高"],
    "13":["遮瑕力强","控 油","持久度高","易推开","轻 薄","妆感自然","保湿度高","防晒指数高"],
    "14":["遮瑕力强","妆感自然","不干燥","不浮粉","持久度高"],
    "15":["遮瑕力强","易推开","持久度高","妆感自然","不干燥","不浮粉"],
    "16":["有","没有"],
    "17":["唱片粉底霜","无瑕疵粉饼","易举多得调色霜","贝玲妃粉底液","贝玲妃粉底遮瑕膏","没 有"],
    "18":["价 格","包 装","品 牌","功 效"],
    "19":["遮瑕力","粉 质","色 号","持妆力","保湿度","含护肤成分","控 油","光泽度","轻薄度","防晒指数"],
    "20":["价 格","包 装","品 牌","功 效"],
    "21":["遮瑕力","粉 质","色 号","持妆力","保湿度","含护肤成分","控 油","光泽度","轻薄度","防晒指数"],
}


Array.prototype.indexOf = function(val) {
    for (var i = 0; i < this.length; i++) {
        if (this[i] == val) return i;
    }
    return -1;
};

Array.prototype.remove = function(val) {
    var index = this.indexOf(val);
    if (index > -1) {
        this.splice(index, 1);
    }
};

function questionnaire(opts){

    this.opts={
        item:"",
        cur:"select",
        skipbtn: "",
        cqNum:"1",
        nbtn:"",
        finshbtn:"",
        qlength:"1",
        selected:["q6","q8","q9","q10","q11","q12","q13","q14","q15","q17","q18","q19","q20","q21"],
        doubleArr: ["q11","q12","q13","q15","q19","q21"],
        result:{},
        asciiFun: function(val){
            return String.fromCharCode(parseInt(val+65));
        },
        isArrayFun: function(obj) {
            return Object.prototype.toString.call(obj) === '[object Array]';
        },
        touchEvents : {
            touchstart: "touchstart",
            touchmove: "touchmove",
            touchend: "touchend",

            /**
             * @desc:判断是否pc设备，若是pc，需要更改touch事件为鼠标事件，否则默认触摸事件
             */
            initTouchEvents: function () {
                if (isPC()) {
                    this.touchstart = "mousedown";
                    this.touchmove = "mousemove";
                    this.touchend = "mouseup";
                }
            }
        }
    }

    for (var i in opts) {
        this.opts[i]=opts[i];
    }

    this.init();
}


questionnaire.prototype={
    init: function(){

        var _this = this,
            a = _this.opts,
            b = a.item,
            c = a.nbtn,
            d = a.skipbtn,
            e = a.finshbtn,
            touchE = a.touchEvents,
            _touchEnd = touchE.touchend;
        //console.log(b);

        var qModelHtml = $.map(anwser,function(v,k){
            //console.log(k+":"+v);
            var anwerlistHtml = $.map(v,function(g,h){
                return '<li data-num="'+k+'" data-val="'+a.asciiFun(h)+'"><span><i>'+a.asciiFun(h)+')</i><em>'+g+'</em></span></li>'
            }).join("");
            a["qlength"] = k;
            var statusClass = "";
            if(a["doubleArr"].indexOf("q"+k) >= 0){
                statusClass = "double";
            }

            return '<dl class="'+statusClass+'"><dt><img src="/vstyle/imgs/question/q/'+k+'.png" width="100%" /></dt><dd><ul>'+anwerlistHtml+'</ul></dd></dl>'
        }).join("");

        b.html(qModelHtml);

        b.find("dl li").bind("click",function(){
            _this.clickFun($(this));
        })

        c.bind(_touchEnd, function(){
            _this.nextFun();
        })

        d.bind(_touchEnd, function(){
            _this.skipFun();
        })

        e.bind(_touchEnd, function(){
            _this.finshFun();
        })


    },
    clickFun: function(t){

        var _this = this,
            a = _this.opts,
            isId = t.attr("data-num"),
            isVal = t.attr("data-val"),
            tspan = t.find("span");

        if(!a.isArrayFun(a["result"]["q"+isId])){
            a["result"]["q"+isId] = [];
        }

        if(t.hasClass(a.cur)) {
            t.removeClass(a.cur);
            a["result"]["q"+isId].remove(isVal);
        }else{
            if(a["selected"].indexOf("q"+isId) < 0){
                a["result"]["q"+isId] = [];
                t.siblings().removeClass(a.cur);
            }

            a["result"]["q"+isId].push(isVal);
            t.addClass(a.cur);
        }
        //console.log(JSON.stringify(a["result"]));

        if(isId == "16"){
            if(isVal=="B" && t.hasClass(a.cur)){
                $(".footer").hide();
                $(".f_lottery").show();
            }else{
                $(".footer").hide();
                $(".f_default").show();
            }
        }


    },
    nextFun: function(){
        var _this = this,
            a = _this.opts,
            b = a.item;

        if(!a.isArrayFun(a["result"]["q"+a["cqNum"]])){
            a["result"]["q"+a["cqNum"]] = [];
        }

        if(a["cqNum"] >= a["qlength"] || a["result"]["q"+a["cqNum"]].length <= 0) return false;

        a["cqNum"]++;

        b.find("dl").hide();
        b.find("dl").eq(parseInt(a["cqNum"]-1, 10)).css({"display":"inline-block"});

        if(a["cqNum"] == a["qlength"]){
            $(".footer").hide();
            $(".f_lottery").show();
        }

    },
    skipFun: function(){
        var _this = this,
            a = _this.opts,
            b = a.item;

        if(a["cqNum"] >= a["qlength"]) return false;

        a["result"]["q"+a["cqNum"]] = [];

        a["cqNum"]++;

        b.find("dl").hide();
        b.find("dl").eq(parseInt(a["cqNum"]-1, 10)).css({"display":"inline-block"});

        if(a["cqNum"] == a["qlength"]){
            $(".footer").hide();
            $(".f_lottery").show();
        }
    },
    finshFun: function(){
        var _this = this,
            a = _this.opts;
        $(".loading").show();
        $.ajax({
            type: "POST",
            url: "/api/question/action/submitdata",
            data: {
                "answers": JSON.stringify(a["result"])
            },
            dataType:"json"
        }).done(function(data){
            if(data == "12"){  //未中奖
                window.location.href="notwin";
            }else if(data == "11"){
                formErrorTips("数据格式错误");
            }else if(data == "13"){
                formErrorTips("提交错误");
            }else{
                window.location.href="form?code="+data;
            };
            $(".loading").hide();
        }).fail(function(){
            formErrorTips("提交错误");
            $(".loading").hide();
        })

        //alert("...亲, 你竟然中奖了");
    }
}


window.questionnaire=questionnaire;


var qa = new questionnaire({
    item: $('#questionList'),
    nbtn: $('.nextBtn'),
    skipbtn: $('.skipBtn'),
    finshbtn: $('.lotteryBtn'),
});




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
