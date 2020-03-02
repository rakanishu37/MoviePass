<script>
	Array.from(document.querySelectorAll('.mdc-button'))
		.forEach(rippleTarget => {
			const buttonRipple = document.createElement("span");
			buttonRipple.classList.add("mdc-button__ripple");
			rippleTarget.appendChild(buttonRipple);
			mdc.ripple.MDCRipple.attachTo(rippleTarget)
		});

	Array.from(document.querySelectorAll('.mdc-text-field'))
		.forEach(mdcTextField => new mdc.textField.MDCTextField(mdcTextField));

	Array.from(document.querySelectorAll('.mdc-menu'))
		.forEach(mdcMenu => new mdc.menu.MDCMenu(mdcMenu));
	// TODO: REVISAR SI LAS INSTANCIAS ESTAN BIEN *(LO DUDO)
	const radio = Array.from(document.querySelectorAll('.mdc-radio'))
		.forEach(mdcRadio => new mdc.radio.MDCRadio(mdcRadio));
	const formField = Array.from(document.querySelectorAll('.mdc-form-field'))
		.forEach(mdcFormField => new mdc.radio.MDCRadio(mdcFormField));
	if (formField){
		formField.forEach(fField => fField.input = radio);
	}
	// TODO: REVISAR, NO ANDA
	const select = Array.from(document.querySelectorAll('.mdc-select'))
		.forEach(mdcSelect => new mdc.select.MDCSelect(mdcSelect));
	// select.listen('MDCSelect:change', () => {
	// 	alert(`Selected option at index ${select.selectedIndex} with value "${select.value}"`);
//});
</script>
