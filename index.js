const navigate = (location) => document.location=`${location}`

const displayAddress = () => {
    const checkBox = document.getElementById("displayAddress")
    if(checkBox.checked)
        document.getElementById('endereco-alternativo').style.display = "none"
    else
    document.getElementById('endereco-alternativo').style.display = "block"
}

const setProductCookie = (id, elem) => {
    strId = "prod" +id
    if(elem.checked){
        document.cookie = `${strId}=1`
        return
    }
    document.cookie = `${strId}=0`
    
}