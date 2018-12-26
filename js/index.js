const appName = {
    name: "Eugene Dee",
    version: "5.6",
    date: "26th December, 2018",
    run: function(){
    return console.log("%cApp Info=> Name: "+this.name+" - Version: "+this.version+" - Date: "+this.date+" - .", "background: #000;padding:5px;color:#fff;");
    }
}

appName.run();
