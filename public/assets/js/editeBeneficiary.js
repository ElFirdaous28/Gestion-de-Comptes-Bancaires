function showBeneficiaryInfo(event){
    const beneficiary =event.target.closest(".beneficiary");

    document.getElementById("beneficiary_id_input").value=beneficiary.getAttribute("data-beneficiary-id");
    document.getElementById("beneficiary_name_input").value=beneficiary.querySelector(".beneficiary_name").textContent.trim();
    document.getElementById("beneficiary_account_id_input").value=beneficiary.querySelector(".beneficiary_account_id").textContent.trim();
    document.getElementById("beneficiary_account_id_input").disabled ="true";
    
    document.getElementById("save_beneficiary_button").setAttribute("name","editeBeneficiary");
    document.getElementById("save_beneficiary_button").innerText="Save";

    document.getElementById("save_beneficiary_form").setAttribute("action", "benificiers/updateBeneficiary");
}

document.getElementById("annuler").addEventListener("click", () => {
    document.getElementById("save_beneficiary_form").reset();
});