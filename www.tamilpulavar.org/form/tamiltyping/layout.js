var isIE = document.all ? true : false;
SelectedTab = 0;
SelectedMenu = 0;
SelectedSubMenu = 0;
AdLength = 1;

function menuItem(name, path) {                      // Define a main tab
	this.name = name;
	this.path = path;
	this.nxt = new Array();
}

function showTab() {
	let txt = "";
	txt += '<div id="MasterMenu">'
	for (i = 0; i < tabList.length - 1; i++) {
		//+ tabList[i].name +
		txt += '<a class="" href="' + tabList[i].path + '">' + tabList[i].name + '</a>';
	}

	txt += ''

	Menu = tabList[SelectedTab].nxt
	if (Menu.length != 0) {
		txt += ''
		for (i = 0; i < Menu.length; i++) {
			if (i == SelectedMenu)
				cls = 'selconvbtn';
			else
				cls = 'convbtn';
			txt += '<a class=' + cls + ' href="' + Menu[i].path + '" onmouseover="popupSubMenu(event,' + SelectedTab + ',' + i + ')">'
				+ Menu[i].name + '</a>';
		}
	}


	if (navigator.language) { mylanguage = navigator.language; }
	else if (navigator.browserLanguage) { mylanguage = navigator.browserLanguage; }

	if ((mylanguage.toLowerCase() == 'en-us') || (mylanguage.toLowerCase() == 'en-ca'))
		txt += '';
	else
		txt += '';

	txt += '';
	return txt;
}

function popupSubMenu(e, SelectedTab, SelectedMenu) {
	SubMenu = tabList[SelectedTab].nxt[SelectedMenu].nxt;
	if (SubMenu.length != 0) {
		txt = ''
		for (i = 0; i < SubMenu.length; i++) {
			if (i == SelectedSubMenu)
				cls = 'selconvbtn';
			else
				cls = 'convbtn';
			txt += '<a class=' + cls + ' href="' + SubMenu[i].path + '">'
				+ SubMenu[i].name + '</a>';
		}
		txt += '</div></div>';

		if (document.getElementById('PopupMenu') == null) {
			pmnudiv = document.createElement('div');
			pmnudiv.setAttribute('id', 'PopupMenu');
			pmnudiv.setAttribute('align', 'left');
			bdy = document.getElementsByTagName('BODY')[0];
			bdy.appendChild(pmnudiv);

			pmnustyle = getStyleObject('PopupMenu');
			pmnustyle.width = '140px';
			pmnustyle.backgroundColor = '#FFFFFF';
			pmnustyle.position = 'absolute';
			if (isIE) { pmnustyle.left = '355px'; pmnustyle.top = e.clientY - 15; }
			else { pmnustyle.left = '370px'; pmnustyle.top = e.pageY - 15; }
		}
		else {
			pmnudiv = document.getElementById('PopupMenu');
			pmnustyle = getStyleObject('PopupMenu');
		}
		pmnudiv.innerHTML = txt;
		pmnustyle.display = 'inline';
		document.onclick = hideSubMenu;
	}
	else {
		pmnustyle = getStyleObject('PopupMenu');
		pmnustyle.display = 'none';

	}
}

function hideSubMenu() {
	pmnustyle = getStyleObject('PopupMenu');
	pmnustyle.display = 'none';
}

function getStyleObject(objectId) {
	// cross-browser function to get an object's style object given its
	if (document.getElementById && document.getElementById(objectId)) {
		// W3C DOM
		return document.getElementById(objectId).style;
	} else if (document.all && document.all(objectId)) {
		// MSIE 4 DOM
		return document.all(objectId).style;
	} else if (document.layers && document.layers[objectId]) {
		// NN 4 DOM.. note: this won't find nested layers
		return document.layers[objectId];
	} else {
		return false;
	}
} // getStyleObject

