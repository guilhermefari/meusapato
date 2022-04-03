const navigate = (location) => document.location=`${location}`

const displayAddress = () => {
    setRequiredValues()
    const checkBox = document.getElementById("displayAddress")
    if(checkBox.checked){
        document.getElementById('endereco-alternativo').style.display = "none"
        document.getElementById('endAtual').style.display = "block"
        document.getElementById('endAtualForm').value = "true"
    }
    else{
        document.getElementById('endereco-alternativo').style.display = "block"
        document.getElementById('endAtual').style.display = "none"
        document.getElementById('endAtualForm').value = "false"
    }
}

const setRequiredValues = () => {
    document.getElementById('logradouro').required = !document.getElementById('logradouro').required
    document.getElementById('numero').required = !document.getElementById('numero').required
    document.getElementById('cidade').required = !document.getElementById('cidade').required
    document.getElementById('cep').required = !document.getElementById('cep').required
    document.getElementById('nomeAssociado').required = !document.getElementById('nomeAssociado').required
}

const setProductCookie = (id, elem) => {
    strId = "prod" +id
    if(elem.checked){
        document.cookie = `${strId}=1`
        return
    }
    document.cookie = `${strId}=0`
}

const unsetCookies = () => {
    const cookies = document.cookie.split(";");

    for (const cookie of cookies) {
        const eqPos = cookie.indexOf("=")
        const name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie
        if(name != 'cpf' && name != 'username') document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT"
    }
}