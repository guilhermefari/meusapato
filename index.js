const navigate = (location) => document.location=`${location}`

const displayAddress = () => {
    const checkBox = document.getElementById("displayAddress")
    if(checkBox.checked)
        document.getElementById('endereco-alternativo').style.display = "none"
    else
    document.getElementById('endereco-alternativo').style.display = "block"
}