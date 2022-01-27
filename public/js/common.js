window.addEventListener('load', (event) => {
    let templatesList = document.getElementById('templates-list');

    // メッセージ追加画面のテンプレート選択の処理
    // selectTemplate()
    templatesList.onchange = selectTemplate;
    function selectTemplate(){
        document.getElementById("sentence-input").innerHTML = document.getElementById("templates-list").value
    }

    // 大工追加の処理
    document.getElementById('add-carpenter').addEventListener("click",()=>{
        let carpenterItem = document.getElementsByClassName("carpenter-item")
        let cloneElement = carpenterItem[0].cloneNode(true)
        document.querySelector("#carpenter-list .carpenter-item:last-child").after(cloneElement)
    })

    // 大工削除の処理
    document.getElementById('carpenter-list').addEventListener("click",(e)=>{
        if (e.target.className == 'carpenter-item-deletebtn'){
            e.target.closest('.carpenter-item').remove()
        }
    })
    document.getElementById('test-button').addEventListener("click",()=>{
        console.log("送信")
    })
});
//


