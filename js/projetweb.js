function res(variable)
{var chaine = 'test'+variable;
var chaine2 = 'resultat'+variable;
document.getElementById(chaine).href="../controller/setResultat.controller.php?idM="+variable+"&Res="+document.getElementById(chaine2).options[document.getElementById(chaine2).selectedIndex].value;}

function prono(variable)
{var chaine = 'test'+variable;
var chaine2 = 'resultat'+variable;
document.getElementById(chaine).href="../controller/setProno.controller.php?idM="+variable+"&Res="+document.getElementById(chaine2).options[document.getElementById(chaine2).selectedIndex].value;}

