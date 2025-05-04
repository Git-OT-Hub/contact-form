"use strict";

{
    document.querySelectorAll('button.contact__show-button').forEach((btn) => {
        btn.addEventListener("click", () => {
            let contactId = btn.value;
            let mask = document.querySelector("#cantacts_mask");
            let contact = document.querySelector(`#admin-contact_${contactId}`);

            mask.classList.remove("hidden");
            contact.classList.remove("hidden");
        });
    });

    document.querySelectorAll('button.contact__show-delete--button').forEach((btn) => {
        btn.addEventListener("click", () => {
            let contactId = btn.value;
            let mask = document.querySelector("#cantacts_mask");
            let contact = document.querySelector(`#admin-contact_${contactId}`);

            mask.classList.add("hidden");
            contact.classList.add("hidden");
            console.log(contactId);
        });
    });
}