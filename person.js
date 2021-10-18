load();
document.getElementById("tailieu").addEventListener("click", nextSection1);
document.getElementById("thongtin").addEventListener("click", nextSection2);
document.getElementById("profile").addEventListener("click", nextSection3);
document.getElementById("setting").addEventListener("click", nextSection4);



function nextSection1() {
    document.getElementById("tai-lieu").style.display = "block";
    document.getElementById("thong-tin").style.display = "none";
    document.getElementById("pro-file").style.display = "none";
    document.getElementById("set-ting").style.display = "none";

}

function nextSection2() {
    document.getElementById("tai-lieu").style.display = "none";
    document.getElementById("thong-tin").style.display = "block";
    document.getElementById("pro-file").style.display = "none";
    document.getElementById("set-ting").style.display = "none";
}

function nextSection3() {
    document.getElementById("tai-lieu").style.display = "none";
    document.getElementById("thong-tin").style.display = "none";
    document.getElementById("pro-file").style.display = "block";
    document.getElementById("set-ting").style.display = "none";
}

function nextSection4() {
    document.getElementById("tai-lieu").style.display = "none";
    document.getElementById("thong-tin").style.display = "none";
    document.getElementById("pro-file").style.display = "none";
    document.getElementById("set-ting").style.display = "block";
}
function btn(index) {
    document.getElementsByClassName("files")[index].click();
}
function load() {
    let string;
    for (let i = 0; i < document.getElementsByClassName("files").length; i++) {
        document.getElementsByClassName("files")[i].addEventListener("change", () => {
            const filename = document.getElementsByClassName("files")[i].files[0];
            if (filename) {
                const reader = new FileReader();reader.onload = function () {
                const result = reader.result;  string = result;
                document.getElementsByClassName("img")[i].src = string;
                }
                reader.readAsDataURL(filename);
            }
        });
    }
}


