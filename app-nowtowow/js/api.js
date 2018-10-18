/*All the api collection*/
Api = {
    //抽奖
    //返回code 1  抽中   code 2  未抽中
    isLottery:function(callback){
        $.ajax({
            url:'/api/livelottery',
            type:'POST',
            dataType:'json',
            success:function(data){
                return callback(data);
            }
        });
    },
    //name mobile  address
    //返回code 1  提交成功  code 2信息不完整
    submitInfo:function(obj,callback){
        $.ajax({
            url:'/api/submitinfo',
            type:'POST',
            dataType:'json',
            data:obj,
            success:function(data){
                return callback(data);
            }
        });
    },
    serviceJson:[
        {
            title:'水疗中心',
            //type:[{name:'test'},{name:'RDV 美妆'},{name:'美妆课堂'},{name:'RDV 护理'},{name:'导游服务'},{name:'购物助理'}],
        },{
            title:'VIP服务',
            type:[{name:'香水邀约'},{name:'妆容打造'},{name:'美妆课堂'},{name:'护肤预约'},{name:'导游服务'},{name:'购物助理'}]
        },{
            title:'定制服务',
            //type:[]
        },{
            title:'Le 68餐厅',
            //type:['']
        }
    ],



};