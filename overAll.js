function main(){

}

function insert(){

}

function search(){
var select = document.getElementById('select');
var selectValue = document.getElementById('selectValue');

  var username=req.body.uname;
    var pwd=req.body.psd;
    var sql="select * from student where ?=? ";
   var con=dbcon.getCon();
    con.query(sql,[select.value,selectValue.value], function (err,result) {
          if(!err){
              if(result.length==0){
                  res.json(0);
              }else{
                  res.json(1)
              }
          }else{
             console.log(err)
          }
        con.destroy()
    })
}