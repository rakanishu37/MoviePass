<?php

/* Base Component Function */
$Component = function ($render) {
	return function ($propsArray) use ($render) {
		return $render((object) $propsArray);
	};
};

/**
 * Material Button.
 */
$MaterialButton = $Component(function ($props) {
	$raisedClass = isset($props->raised) && $props->raised ? " mdc-button--raised" : "";
	$type = isset($props->type) ? $props->type : "button";
	$name = isset($props->name) ? " name=\"$props->name\"" : "";
	$value = isset($props->value) ? " value=\"$props->value\"" : "";

	return "
		<button
			class=\"mdc-button$raisedClass\"
			type=\"$type\"
			title=\"$props->title\"
			$name
			$value
		>$props->title</button>
	";
});

/**
 * Material Link Button.
 */
$MaterialButtonLink = $Component(function ($props) {
	$raisedClass = isset($props->raised) && $props->raised ? " mdc-button--raised" : "";
	$type = isset($props->type) ? $props->type : "button";

	return "
		<button
			class=\"mdc-button$raisedClass\"
			type=\"$type\"
			title=\"$props->title\"
			onclick=\"location.href='$props->link'\"
		>$props->title</button>
	";
});

/**
 * Material Submit Button.
 */
$MaterialSubmitButton = $Component(function ($props) use ($MaterialButton) {
	return $MaterialButton(array_merge([
		"type" => "submit",
		"raised" => true
	], (array) $props));
});

/**
 * Material TextField.
 */
$MaterialTextField = $Component(function ($props) {
	$required = isset($props->required) ? " required" : "";
	$min = isset($props->min) ? " min=\"$props->min\"" : "";
	$placeholder = isset($props->placeholder) ? " placeholder=\"$props->placeholder\"" : "";
	$value = isset($props->value) ? " value=\"$props->value\"" : "";

	return "
		<div class=\"mdc-text-field mdc-text-field--outlined\">
			<input
				class=\"mdc-text-field__input\"
				id=\"$props->name\"
				name=\"$props->name\"
				type=\"$props->type\"$value$placeholder$required$min>
			<div class=\"mdc-notched-outline\">
				<div class=\"mdc-notched-outline__leading\"></div>
				<div class=\"mdc-notched-outline__notch\">
					<label
						for=\"$props->name\"
						class=\"mdc-floating-label\"
					>$props->title</label>
				</div>
				<div class=\"mdc-notched-outline__trailing\"></div>
			</div>
		</div>
	";
});

/**
 * Material Icon Button.
 */
$MaterialIconButton = $Component(function ($props) {
	return "
		<button
			aria-label=\"$props->label\"
			title=\"$props->label\"
			class=\"material-icons mdc-top-app-bar__action-item mdc-icon-button\"
			onclick=\"location.href='$props->target'\"
		>$props->icon</button>
	";
});

/**
 * Material Item.
 */
$MaterialItem = $Component(function ($props) {
	return "
	<li class=\"mdc-list-item\" role=\"menuitem\">
		<span
			class=\"mdc-list-item__text\"
			onclick=\"location.href='$props->target'\"
		>$props->name</span>
	</li>";
});

/**
 * Material Menu.
 */
$MaterialMenu = $Component(function ($props) use ($MaterialItem) {
	$items = join(array_map($MaterialItem, $props->items));
	return "
		<div class=\"mdc-menu mdc-menu-surface\">
			<ul class=\"mdc-list\" role=\"menu\" aria-hidden=\"true\" aria-orientation=\"vertical\" tabindex=\"-1\">
			$items
			</ul>
		</div>
	";
});

/**
 * Material Menu Icon Button. TODO: FINISH THIS
 */
$MaterialMenuIconButton = $Component(function ($props) {
	return "
		<button
			aria-label=\"$props->label\"
			title=\"$props->label\"
			class=\"material-icons mdc-top-app-bar__action-item mdc-icon-button\"
			onclick=\"'\"
		>$props->icon</button>

	";
});

$MaterialTableHead = $Component(function ($props){
	return "
		<th class=\"mdc-data-table__header-cell\" role=\"columnheader\" scope=\"col\">$props->content</th>
	";
});

$MaterialTableData = $Component(function ($props) {
	return "
		<td class=\"mdc-data-table__cell\">$props->content</td>
	";
});

$MaterialTableRow = $Component(function ($props) use ($MaterialTableData) {
	$data = join(array_map($MaterialTableData, $props->data));
	return "
	<tr class=\"mdc-data-table__row\">
		$data
	</tr>
	";
});

$MaterialDataTable = $Component(function ($props) use ($MaterialTableHead, $MaterialTableRow) {
	$columns = join(array_map($MaterialTableHead, $props->columns));
	$rows = join(array_map($MaterialTableRow, $props->rows));
	return "
	<div class=\"mdc-data-table\">
		<table class=\"mdc-data-table__table\" aria-label=\"Dessert calories\">
			<thead>
			<tr class=\"mdc-data-table__header-row\">
				$columns
			</tr>
			</thead>
			<tbody class=\"mdc-data-table__content\">
				$rows
			</tbody>
		</table>
	</div>
	";
});

$MaterialRadioButton = $Component(function ($props) {
	$checked = isset($props->checked) ? " checked" : "";
	$required = isset($props->required) ? " required" : "";
	return "
	<div class=\"mdc-form-field\">
		<div class=\"mdc-radio\">
		<input class=\"mdc-radio__native-control\"
			type=\"radio\"
			id=\"$props->id\"
			name=\"$props->name\"
			value=\"$props->value\"
			$checked
			$required>
		<div class=\"mdc-radio__background\">
			<div class=\"mdc-radio__outer-circle\"></div>
			<div class=\"mdc-radio__inner-circle\"></div>
		</div>
		<div class=\"mdc-radio__ripple\"></div>
		</div>
		<label for=\"$props->id\">$props->label</label>
	</div>
	";
});

$MaterialSelectItem = $Component(function($props){
	return "
	<li class=\"mdc-list-item\" data-value=\"$props->value\">
		$props->item
	</li>
	";
});

$MaterialSelectedItem = $Component(function($props) {
	return "
		<li class=\"mdc-list-item mdc-list-item--selected\" data-value=\"$props->value\" aria-selected=\"true\">
			$props->item
		</li>
	";
});

$MaterialSelectMenu = $Component(function($props) use ($MaterialSelectItem, $MaterialSelectedItem) {
	$items = join(array_map($MaterialSelectItem, $props->items));
	$selectedItem = $MaterialSelectedItem($props->selectedItem);
	return "
	<div class=\"mdc-select\">
		<div class=\"mdc-select__anchor demo-width-class\">
		<i class=\"mdc-select__dropdown-icon\"></i>
		<div class=\"mdc-select__selected-text\"></div>
		<span class=\"mdc-floating-label\">$props->label</span>
		<div class=\"mdc-line-ripple\"></div>
		</div>

		<div class=\"mdc-select__menu mdc-menu mdc-menu-surface demo-width-class\">
		<ul class=\"mdc-list\">
			$selectedItem
			$items
		</ul>
		</div>
	</div>
	";	
});

$MaterialImage = $Component(function($props) {
	return "
	<img src=\"$props->img\">
	";
});
