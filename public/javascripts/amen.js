function viewDevelopers (id) {
  const loading = layer.load(2,{time:10*1000});
  $.ajax({
    type: "POST",
    url: "api/project",
    data: {id:id},
    timeout: 10*1000,
    async: false,
    success: function(msg){
      layer.open({
        type: 1,
        content: msg //这里content是一个普通的String
      });
    },
    error: function(jqXHR, textStatus, errorThrown){
      layer.alert(textStatus)
    }
  })
  layer.close(loading)
}
!(function($) {
  "use strict";
  $("#Query").click(function (){
    layer.prompt({title: '成员查询,请输入您要查询的QQ号'},function(value, index, elem){
      const query = layer.load(1, {time: 10 * 1000});
      $.ajax({
        type: "POST",
        url: "api/query",
        data: {qq:value},
        timeout: 10*1000,
        async: false,
        success: function(msg){

        },
        error: function(jqXHR, textStatus, errorThrown){
          layer.alert(textStatus)
        }
      })
      layer.close(query);
      // layer.close(index);
    });

  });
  $("#Join").click(function (){
    layer.alert("暂未开发自助加入服务。请点击导航栏的联系进行操作")
  });
  $("#email_submit").click(function () {
    layer.alert("未做，请手动发送邮箱")
  });



})(jQuery);
