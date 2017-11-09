//*****************************************************************************
function tblMouseOver(){
	if (event.srcElement.tagName=="TD"){
		event.srcElement.title=event.srcElement.innerText;
	}
}
//*****************************************************************************
function AddCookie(key, value) {
    document.cookie = key + "=" + escape(value);
}
//*****************************************************************************
function GetCookie(key) {
    var strCookie = document.cookie;
    var arrCookie = strCookie.split(";");
    var arrKeyValue;
    for (var i=0; i<arrCookie.length; i++) {
        arrKeyValue = arrCookie[i].split("=");
        if (key == arrKeyValue[0]) {
            return arrKeyValue[1];
        }
    }
    return "";
}
//*****************************************************************************
function Trim(str) {
    return str.replace(/^\s+|\s+$/g, "");
}
//*****************************************************************************
function LTrim(str) {
    return str.replace(/(^\s*)/g, "");
}
//*****************************************************************************
function RTrim(str) {
    return str.replace(/(\s*$)/g, "");
}
//*****************************************************************************
function GetMessage(msg, p1, p2, p3, p4, p5) {
    msg = ReplaceAll(msg, "#1", p1);
    msg = ReplaceAll(msg, "#2", p2);
    msg = ReplaceAll(msg, "#3", p3);
    msg = ReplaceAll(msg, "#4", p4);
    msg = ReplaceAll(msg, "#5", p5);
    return msg;
}
//*****************************************************************************
function ReplaceAll(str, str1, str2) {
    while (str.indexOf(str1) != -1) {
        str = str.replace(str1, str2);
    }
    return str;
}
//*****************************************************************************
function GetNumber(str) {
    if (IsEmpty(str) || !IsNumber(str)) {
        return 0;
    }
    return parseInt(str,10);
}
//*****************************************************************************
function GetNextSibling(obj) {
    var nextObj = obj.nextSibling;
    if (null == nextObj) return null;
    while (nextObj && nextObj.nodeType != 1) {
        nextObj = nextObj.nextSibling;
    }
    return nextObj;
}
//*****************************************************************************
function GetPreviousSibling(obj) {
    var previousObj = obj.previousSibling;
    if (null == previousObj) return null;
    while (previousObj && previousObj.nodeType != 1) {
        previousObj = previousObj.previousSibling;
    }
    return previousObj;
}
//*****************************************************************************
function IsEmpty(str) {
    return (null == str || "" == str || 0 == str.length);
}
//*****************************************************************************
function IsAlphabet(str) {  // str.search("^[0-9a-zA-Z_]*$")
    return !str.match(/[^A-Za-z]+/);
}
//*****************************************************************************
function IsNumber(str) {  // str.search("^[0-9]*$")
    return !str.match(/[^0-9]+/);
}
//*****************************************************************************
function IsNumberAndAlphabet(str) {
    return !str.match(/[^0-9A-Za-z_-]+/);
}
//*****************************************************************************
function IsSign(str) {
    return !str.match(/[^ -.+$#!@]+/);  // /[^ -.+$#!/@]+/
}
//*****************************************************************************
function IsValidPwd(str) {
    if ( str.match(/[^\w -.+$#!@]+/)) {  // /[^\w -.+$#!/@]+/
        return false;
    }
    var bAlpha = false;
    var bNumber = false;
    var bSign = false;
    var word;
    for (var i=0; i<str.length; i++) {
        word = str.charAt(i);
        if (IsAlphabet(word)) {
            if (!bAlpha) {
                bAlpha = true;
            }
         }
        if (IsNumber(word)) {
            if (!bNumber) {
                bNumber = true;
            }
        }
        if (IsSign(word)) {
            if (!bSign) {
                bSign = true;
            }
        }
        if (word=="_") {
            if (!bSign) {
                bSign = true;
            }
        }
    }
    return bAlpha && bNumber && bSign;
}
//*****************************************************************************
function IsHankaku(value) {  // value.search("^[��-��]*$")
    var iLength = value.length;
    var code;
    for (var i=0; i<iLength; i++) {
        code = value.charCodeAt(i);
        if ((code != "\n".charCodeAt(0))
            && (code != "\r".charCodeAt(0))
            && (code != " ".charCodeAt(0))
            && !("!".charCodeAt(0) <= code && code <= "~".charCodeAt(0))
            && !("�".charCodeAt(0) <= code && code <= "�".charCodeAt(0))) {
                return false;
        }
    }
    return true;
}
//*****************************************************************************
function IsZenkaku(value) {
    // value.search("^[�@-��]*$")
    // value.search("^[() ���-��߰0-9a-zA-Z_]*$")
    for (var i=0; i<value.length; i++) {
        code = value.charCodeAt(i);
        if ((" ".charCodeAt(0) <= code && code <= "~".charCodeAt(0))
                || ("�".charCodeAt(0) <= code && code <= "�".charCodeAt(0))) {
            return false;
        }
    }
    return true;
}
//*****************************************************************************
function IsCSVFilename(value) {
    /*�A�b�v���[�h�����p�����\����*/
    var csvFilenm=value.toUpperCase();
    var urlCheck = new RegExp("^[a-zA-Z]:(\\\\[^\\\\:\"<>\|\?/\*]+)+\\.(CSV)$","");
    return urlCheck.test(csvFilenm);
}
//*****************************************************************************
function IsValidJPDateCheck(ymd) {
    //�uYYYY/MM/DD�v�Ó����`�F�b�N
    if (IsEmpty(ymd)) {
        return true;
    }
    if (ymd.length != 10) {
        return false;
    }
    if (ymd.substr(4, 1) != "/" || ymd.substr(7, 1) != "/") {
        return false;
    }
    return IsValidDate(ymd.substr(0, 4), ymd.substr(5, 2), ymd.substr(8, 2));
}
//*****************************************************************************
function IsValidDateCheck(ymd) {

    if (IsEmpty(ymd)) {

        return true;
    }
    if (ymd.length != 8) {
        return false;
    }
    return IsValidDate(ymd.substr(0, 4), ymd.substr(4, 2), ymd.substr(6, 2));
}
//*****************************************************************************
function IsValidDate(year, month ,date) {
    var y,m,d;
    var monthDays = new Array(31,28,31,30,31,30,31,31,30,31,30,31);
    if (IsEmpty(year)) {
        return false;
    }
    if (IsEmpty(month)) {
        return false;
    }
    if (IsEmpty(date)) {
        return false;
    }
    try {
        y = parseInt(year,10);
        m = parseInt(month,10);
        d = parseInt(date,10);
    } catch(e) {
        return false;
    }
    if ((y%4 == 0) && (y%100 != 0 || y%400 == 0)) {
        monthDays[1] = 29;
    }
    if (m >= 1 && m <= 12) {
        return d >= 1 && d <= monthDays[m-1];
    } else {
        return false;
    }
    return true;
}
//*****************************************************************************
function GetLength(str) {
    var iLength = str.length;
    return iLength;
}
//*****************************************************************************
function ChangeYearAndMonth(year, month, day) {
    var yearSelect = document.all(year);
    var monthSelect = document.all(month);
    var daySelect = document.all(day);
    var y = yearSelect.options[yearSelect.selectedIndex].text;
    var m = monthSelect.options[monthSelect.selectedIndex].text;
    if(IsEmpty(y) || IsEmpty(m)){
        return false;
    }
    SetDaySelect(daySelect, GetDays(y, m));
}
//*****************************************************************************
function SetDaySelect(daySelect, days) {
    var now_length = daySelect.length;
    daySelect.length = days + 1;

    for (var i=now_length; i<days+1; i++) {
        if (i < 10) {
            daySelect.options[i].value = '0' + (i);
            daySelect.options[i].text = '0' + (i);
        } else {
            daySelect.options[i].value = i;
            daySelect.options[i].text = i;
        }
    }
}
//*****************************************************************************
function GetDays(y, m) {
    if (m == 1 || m == 3 || m == 5 || m == 7 || m == 8 || m == 10 || m == 12) return 31;
    else if (m == 4 || m == 6 || m == 9 || m == 11) return 30;
    else {
        if (!(y%4) && ((y%100) || !(y%400))) return 29;
        else  return 28;
    }
}
//*****************************************************************************
function CompareDate(fromDate, toDate) {
     if(IsEmpty(fromDate) || IsEmpty(toDate)){
        return false;
    }
    var d1 = new Date(fromDate);
    var d2 = new Date(toDate);
    if(d2 < d1){
        return false;
    }
//    var d = new Date(d1.getYear() + 2, d1.getMonth() , d1.getDate());
//    if(d2 > d){
//        return false;
//    }
    return true;
}
//*****************************************************************************
function DateFormatter(d, pattern) {
    if (typeof pattern != "string") return;
    var dYear = d.getFullYear();
    var dMonth = d.getMonth();
    var dDate = d.getDate();
    //var dDay = d.getDay();
    var dHours = d.getHours();
    var dMinutes = d.getMinutes();
    var dSeconds = d.getSeconds();
    var res = "";
    var len = pattern.length;
    var c;
    for (var i = 0; i < len; i++) {
        c = pattern.charAt(i);
        switch (c) {
            case "Y":
                res += dYear;
                break;
            case "m":
                res += this.PreZero(dMonth + 1);
                break;
            case "d":
                res += this.PreZero(dDate);
                break;
            case "H":
                res += this.PreZero(dHours);
                break;
            case "i":
                res += this.PreZero(dMinutes);
                break;
            case "s":
                res += this.PreZero(dSeconds);
                break;
            default :
                res += c;
            break;
        }
    }
    return res;
}
//*****************************************************************************
function PreZero(value) {
    return (parseInt(value) < 10) ? "0" + value : value;
}
//*****************************************************************************
function GetSysTime() {
    var now = new Date();
    var str = DateFormatter(now, "YmdHis");
    return str;
}
//*****************************************************************************
function Logout() {
    JspUrlJump("login.jsp");
}
//*****************************************************************************
function GoMenu() {
    JspUrlJump("menu.jsp");
}
//*****************************************************************************
function JspUrlJump(url) {
    DisableBtn();
    url = url + "?time=" + GetSysTime();
    window.parent.location.href = url;
}
//*****************************************************************************
function JspActSubmit(form) {
    form.action = form.action + "?time=" + GetSysTime();
    form.submit();
    DisableBtn();
}
//*****************************************************************************
function DisableBtn() {
    for(var k=0; k<document.forms.length; k++ ) {
        var fm = document.forms[k];
        for(var i=0; i<fm.length; i++) {
            var obj = fm.elements[i];
            if(obj.type == "button" || obj.type == "reset" || obj.type == "select-one") {
                obj.disabled = true;
            }
        }
    }
}
//*****************************************************************************
function UnDisableBtn() {
    for(var k=0; k<document.forms.length; k++ ) {
        var fm = document.forms[k];
        for(var i=0; i<fm.length; i++) {
            var obj = fm.elements[i];
            if(obj.type == "button" || obj.type == "reset" || obj.type == "select-one") {
                obj.disabled = false;
            }
        }
    }
}

//*****************************************************************************
function DoPopSessionTimeOut() {
    if (window.dialogArguments != null) {
        DoPopParentSessionTimeOut();
    } else {
        window.location.href = "../sysTimeOut.jsp";
        window.focus();
    }
}
//*****************************************************************************
function DoPopParentSessionTimeOut() {
    window.dialogArguments.parent.DoPopSessionTimeOut();
    window.close();
}
//*****************************************************************************
function GetPopupPatch() {
    if (window.location.href.indexOf("/pop/") > -1) {
        return "../";
    }
    return "";
}
//*****************************************************************************
function DoOpenModalDialog(url, openwin, style) {
    if (openwin == null || openwin == "") openwin = window;
    var rt = openwin.showModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function DoOpenModelessDialog(url, openwin, style) {
    if (openwin == null || openwin == "") openwin = window;
    var rt = openwin.showModelessDialog(url, {doc:document,win:parent}, style);
    return rt;
}
//*****************************************************************************
function OpenDetailPreview(PageInitFlg,openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=detailPreview_s&POP_PAGE_INIT_FLG=" + PageInitFlg + "&time=" + GetSysTime();
    var style = "dialogWidth:510px;dialogHeight:400px;center:1;help:0;resizable:0;status:0;scroll:0;";
    if ("trainunitDetail" == PageInitFlg){
        style = "dialogWidth:900px;dialogHeight:400px;center:1;help:0;resizable:0;status:0;scroll:0;";
    }else if ("learnunitDetail" == PageInitFlg){
        style = "dialogWidth:695px;dialogHeight:400px;center:1;help:0;resizable:0;status:0;scroll:0;";
    }else if ("sectionDetail" == PageInitFlg){
        style = "dialogWidth:695px;dialogHeight:400px;center:1;help:0;resizable:0;status:0;scroll:0;";
    }
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenProcessChangeInfo(PageInitFlg,strPatternCd,strVersion,strProcessId, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=processChangeInfo_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&strPatternCd=" + strPatternCd
    + "&strVersion=" + strVersion
    + "&strProcessId=" + strProcessId
    + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:800px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenProcessDetail(PageInitFlg,strPatternCd,strVersion,strProcessId,strStatus, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=processDetail_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&strPatternCd=" + strPatternCd
    + "&strVersion=" + strVersion
    + "&strProcessId=" + strProcessId
    + "&strStatus=" + strStatus
    + "&time=" + GetSysTime();
    var style = "dialogWidth:620px;dialogHeight:800px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenProcessContents(PageInitFlg, PatternCd, Version, ProcessCd, TrainunitCd, LearnunitCd, PageCd, SectionCd, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=processContents_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&PatternCd=" + PatternCd + "&Version=" + Version  + "&ProcessCd=" + ProcessCd
    + "&TrainunitCd=" + TrainunitCd
    + "&LearnunitCd=" + LearnunitCd
    + "&PageCd=" + PageCd
    + "&SectionCd=" + SectionCd
    + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:800px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenContentDetail(PageInitFlg, ContentCd, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=contentDetail_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&ContentCd=" + ContentCd + "&time=" + GetSysTime();
    var style = "dialogWidth:645px;dialogHeight:800px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenContentList(PageInitFlg, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=contentList_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:800px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenFileDetail(PageInitFlg,strContentCd, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=fileDetail_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&strContentCd=" + strContentCd
    + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:800px;center:1;help:0;resizable:0;status:0;scroll:0;";
    //var style = "height=800,width=800,top="+(screen.height-800)/2+",left="+(screen.width-800)/2+",toolbar=no,menubar=no,scrollbars=no,resizable=no,location=no,status=no";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenTrainunitList(PageInitFlg, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=trainunitList_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:800px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenLearnunitDetail(PageInitFlg,strLearnunitCd,strTrainunitCd, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=learnunitDetail_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&strLearnunitCd=" + strLearnunitCd
    + "&strTrainunitCd=" + strTrainunitCd
    + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:800px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenSectionDetail(PageInitFlg, strLearnunitCd, strSectionCd, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=sectionDetail_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&strLearnunitCd=" + strLearnunitCd
    + "&strSectionCd=" + strSectionCd
    + "&time=" + GetSysTime();
    var style = "dialogWidth:850px;dialogHeight:800px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenTrainunitDetail(PageInitFlg,strTrainunitCd, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=trainunitDetail_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&strTrainunitCd=" + strTrainunitCd
    + "&time=" + GetSysTime();
    var style = "dialogWidth:900px;dialogHeight:800px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenPagePreview(PageInitFlg,openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=pagePreview_s&POP_PAGE_INIT_FLG=" + PageInitFlg + "&time=" + GetSysTime();
    var style = "dialogWidth:650px;dialogHeight:650px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenPageDetail(PageInitFlg,strSectionCd,strPageCd, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=pageDetail_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&strSectionCd=" + strSectionCd
    + "&strPageCd=" + strPageCd
    + "&time=" + GetSysTime();
    var style = "dialogWidth:760px;dialogHeight:800px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenContentSelectPattern(PageInitFlg,strContentCd, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=contentSelectPattern_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&strContentCd=" + strContentCd
    + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:800px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenContentUsedList(PageInitFlg,strContentCd, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=contentUsedList_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&strContentCd=" + strContentCd
    + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:800px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenProcessSelect(PageInitFlg, pattern_cd, version, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=processSelect&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&pattern_cd=" + pattern_cd
    + "&version=" + version
    + "&time=" + GetSysTime();
    var style = "dialogWidth:250px;dialogHeight:605px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenSectionInfoList(PageInitFlg, learnunit_cd, key_word, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=sectionInfoList&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&learnunit_cd=" + learnunit_cd
    + "&key_word=" + encodeURI(encodeURI(key_word))
    + "&time=" + GetSysTime();
    var style = "dialogWidth:720px;dialogHeight:800px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenUserRegis(PageInitFlg, strUserCd, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=userRegis_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&strUserCd=" + strUserCd
    + "&time=" + GetSysTime();
    var style = "dialogWidth:500px;dialogHeight:550px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenTrainStep(PageInitFlg, PatternCd, Version, ProcessId, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=trainStep_s&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&PatternCd=" + PatternCd + "&Version=" + Version  + "&ProcessId=" + ProcessId
    + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:600px;center:1;help:0;resizable:0;status:0;scroll:0;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function OpenFlowChartLookup(PageInitFlg, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=flowChartLookup&POP_PAGE_INIT_FLG=" + PageInitFlg
    + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:750px;center:1;help:0;resizable:0;status:0;scroll:1;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
function SaveReturnMsg(saveFlg) {
    if (saveFlg == "successed") {
        alert(GetMessage(MS039));
    }
}
//*****************************************************************************
function OpenContentLinkByFirefox(fileUrl, style, firefoxKey, firefoxPath) {
    if (!IsEmpty(fileUrl)) {
        if (CheckFirefoxKey(fileUrl, firefoxKey)) {
            var WshShell = new ActiveXObject("WScript.Shell");
            var cmdStr = 'cmd /C dir & cd "' + firefoxPath + '" & start firefox.exe "' + fileUrl + '"';
            WshShell.Run(cmdStr, 0, 0);
        } else {  // �t�@�C���ȊO�ꍇ�u��Fhttp://www.google.co.jp/�v
            window.open(fileUrl, "fileWindow", style);
        }
    }
}

//*****************************************************************************
function CheckFirefoxKey(fileUrl, firefoxKey) {
    if (IsEmpty(firefoxKey)) {
        return false;
    }
    var arrKey = firefoxKey.split(",");
    var iCount = arrKey.length;
    for (var i=0; i<iCount; i++) {
        if (fileUrl.indexOf(arrKey[i]) > -1) {
            return true;
        }
    }
    return false;
}
//*****************************************************************************
//�����ʕҏW��ʃ|�b�v�p
function OpenDepartEditor(PageInitFlg, depId, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=MS02_s&hid_actionMode=" + PageInitFlg
    + "&depId=" + depId
    + "&time=" + GetSysTime();
    var style = "dialogWidth:500px;dialogHeight:260px;resizable: no;status:no;unadorned:no;edge:raised;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}

//*****************************************************************************
//�ėp�}�X�^�[�o�^�p
function OpenGeneralEdit(PageInitFlg, strgeneral_id, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=MS07_s&strHidActionMode=" + PageInitFlg
    + "&strGeneralid=" + strgeneral_id + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:255px;resizable:no;location:no;status:no;unadorned:no;edge:raised;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
//�Ή��ғo�^��ʃ|�b�v�p
function OpenactorEditor(PageInitFlg, actorId, openwin) {
 var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=MS09_s&strHidActionMode=" + PageInitFlg
 + "&strActorId=" + actorId + "&time=" + GetSysTime();
 var style = "dialogWidth:800px;dialogHeight:300px;resizable:no;location:no;status:no;unadorned:no;edge:raised;";
 var rt = DoOpenModalDialog(url, openwin, style);
 return rt;
}
//*****************************************************************************
//���[�o�^��ʃ|�b�v�p
function OpenReportEditor(PageInitFlg, reportId, hid_rdoBtnIndex, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=MS13_s&hid_actionMode=" + PageInitFlg
    + "&hid_reportId=" + reportId + "&hid_rdoBtnIndex=" + hid_rdoBtnIndex + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:340px;resizable:no;location:no;status:no;unadorned:no;edge:raised;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
//���[�}�X�^�����e�i���X��ʃ|�b�v�p
function OpenReport(PageInitFlg, openwin) {
	var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=MS12_s&hid_initBtnFlag=" + PageInitFlg
	+ "&time=" + GetSysTime();
	var style = "dialogWidth:800px;dialogHeight:650px;resizable: no;status:no;unadorned:no;edge:raised;";
	var rt = DoOpenModalDialog(url, openwin, style);
	return rt;
}
//*****************************************************************************
//�Ή��҃}�X�^�����e�i���X��ʃ|�b�v�p
function OpenActor(PageInitFlg, openwin) {
	var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=MS08_s&hid_initBtnFlag=" + PageInitFlg
	+ "&time=" + GetSysTime();
	var style = "dialogWidth:800px;dialogHeight:650px;resizable: no;status:no;unadorned:no;edge:raised;";
	var rt = DoOpenModalDialog(url, openwin, style);
	return rt;
}
//*****************************************************************************
// ��ʃ}�X�^�����e�i���X�o�^�p
function OpenFrameEdit(PageInitFlg, strgeneral_id, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=MS11_s&strHidActionMode=" + PageInitFlg
    + "&strPageId=" + strgeneral_id + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:300px;resizable:no;location:no;status:no;unadorned:no;edge:raised;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//*****************************************************************************
//�Ή��҃}�X�^�����e�i���X��ʃ|�b�v�p
function ProcessOpenActor(PageInitFlg, openwin) {
	var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=MS08_s&hid_initBtnFlag=" + PageInitFlg
	+ "&time=" + GetSysTime();
	var style = "dialogWidth:800px;dialogHeight:650px;resizable: no;status:no;unadorned:no;edge:raised;";
	var rt = DoOpenModalDialog(url, openwin, style);
	return rt;
}
//*****************************************************************************
//��ʃ}�X�^�����e�i���X��ʃ|�b�v�p
function ProcessOpenPage(PageInitFlg, openwin) {
	var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=MS10_s&hid_initBtnFlag=" + PageInitFlg
	+ "&time=" + GetSysTime();
	var style = "dialogWidth:800px;dialogHeight:630px;resizable: no;status:no;unadorned:no;edge:raised;location:no;channelmode:no;";
	var rt = DoOpenModalDialog(url, openwin, style);
	return rt;
}
//���[�}�X�^�����e�i���X��ʃ|�b�v�p
function ProcessOpenReport(PageInitFlg, openwin) {
	var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=MS12_s&hid_actionMode=" + PageInitFlg
	+ "&time=" + GetSysTime();
	var style = "dialogWidth:800px;dialogHeight:650px;resizable: no;status:no;unadorned:no;edge:raised;";
	var rt = DoOpenModalDialog(url, openwin, style);
	return rt;
}
//�v���Z�X�o�^��ʃ|�b�v�p
function OpenProcessEdit(pageInitFlg, patternId, processId, openWin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=PS01&mode=" + pageInitFlg + "&patternId=" + patternId + "&processId=" + processId + "&time=" + GetSysTime();
    var style = "dialogWidth:1024px;dialogHeight:670px;resizable: no;status:no;unadorned:no;edge:raised;";
    var rt = DoOpenModalDialog(url, openWin, style);
    return rt;
}
// ��ʃ��[�U�[�o�^�p
function OpenUserEdit(PageInitFlg, user_id, hid_rdoBtnIndex, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=MS04_s&hid_actionMode=" + PageInitFlg
    + "&userId=" + user_id + "&hid_rdoBtnIndex=" + hid_rdoBtnIndex + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:490px;resizable:no;location:no;status:no;unadorned:no;edge:raised;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}

//��ʃ}�X�^�����e�i���X��ʃ|�b�v�p
function OpenPagesys(PageInitFlg, openwin) {
	var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=MS10_s&hid_initBtnFlag=" + PageInitFlg
	+ "&time=" + GetSysTime();
	var style = "dialogWidth:800px;dialogHeight:630px;resizable: no;status:no;unadorned:no;edge:raised;location:no;channelmode:no;";
	var rt = DoOpenModalDialog(url, openwin, style);
	return rt;
}

//�v���W�F�N�g�o�^��ʃ|�b�v�p
function OpenPJEdit(PageInitFlg, strgeneral_id, openwin) {
	var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=PJ02_s&strHidActionMode=" + PageInitFlg
	+ "&strGeneralid=" + strgeneral_id + "&time=" + GetSysTime();
	var style = "dialogWidth:400px;dialogHeight:200px;resizable:no;status:no;unadorned:no;edge:raised;";
	var rt = DoOpenModalDialog(url, openwin, style);
	return rt;
}

// �p�^�[���E�o�[�W�����o�^
function OpenPattern(PageInitFlg, patternId, hid_rdoBtnIndex, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=PV02_s&hid_actionMode=" + PageInitFlg
    + "&patternId=" + patternId + "&hid_rdoBtnIndex=" + hid_rdoBtnIndex + "&time=" + GetSysTime();
    var style = "dialogWidth:800px;dialogHeight:540px;resizable: no;status:no;unadorned:no;edge:raised;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//�o�̓v���Z�X�I��
function OpenProcessOutput(PageInitFlg, strPatternId, openwin) {
 var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=PV04_s&strHidActionMode=" + PageInitFlg
 + "&strPatternId=" + strPatternId + "&time=" + GetSysTime();
 var style = "dialogWidth:800px;dialogHeight:740px;resizable: no;status:no;unadorned:no;edge:raised;";
 var rt = DoOpenModalDialog(url, openwin, style);
 return rt;
}
//�v���Z�X�ꊇ�ύX��ʃ|�b�v�p
function OpenProcess(PageInitFlg, openwin) {
	var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=PV03_s&hid_actionMode=" + PageInitFlg
	+ "&time=" + GetSysTime();
	var style = "dialogWidth:1220px;dialogHeight:700px;resizable: no;status:no;unadorned:no;edge:raised;";
	var rt = DoOpenModalDialog(url, openwin, style);
	return rt;
}
//�v���Z�X��`��ʃ|�b�v�p
function OpenProcessDefine(PageInitFlg, strPatternId, openwin) {
	 var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=FC00_s&strHidActionMode=" + PageInitFlg
	 + "&strPatternId=" + strPatternId + "&time=" + GetSysTime();
	 var style = "dialogWidth:800px;dialogHeight:650px;resizable: no;status:no;unadorned:no;edge:raised;";
	 var rt = DoOpenModalDialog(url, openwin, style);
	 return rt;
	}
//�����ꊇ�ݒ�
function OpenProcessBulk(processId, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=FC03&processId=" + processId + "&time=" + GetSysTime();
    var style = "dialogWidth:750px;dialogHeight:430px;resizable:no;status:no;unadorned:no;edge:raised;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//�g���K�[�����ύX
function OpenProcessTCondition(processId, tProcessId, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=FC04&processId=" + processId + "&tProcessId=" + tProcessId + "&time=" + GetSysTime();
    var style = "dialogWidth:400px;dialogHeight:300px;resizable:no;status:no;unadorned:no;edge:raised;";
    var rt = DoOpenModalDialog(url, openwin, style);
    return rt;
}
//�t���[�`���[�g�m�F(���[�_��)
function OpenProCheck(pageMode, patternId, processId, selProcessId, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=FC05&pageMode=" + pageMode + "&actionMode=Init"
    + "&patternId=" + patternId + "&processId=" + processId + "&selProcessId=" + selProcessId + "&time=" + GetSysTime();
	var style = "dialogWidth:1010px;dialogHeight:680px;resizable:yes;status:no;unadorned:no;edge:raised;";
	var rt = DoOpenModalDialog(url, openwin, style);
	return rt;
}
//�t���[�`���[�g�m�F(���[�h���[�X)
function OpenProCheckModeless(patternId, parentId,processId, openwin) {
    var url = GetPopupPatch() + "pop/popFrame.jsp?pageId=FC05&pageMode=copy&actionMode=Init&patternId=" + patternId + "&processId="+parentId+"&selProcessId=" + processId + "&time=" + GetSysTime();
	var style = "dialogWidth:1010px;dialogHeight:680px;resizable:yes;status:no;unadorned:no;edge:raised;";
	var rt = DoOpenModelessDialog(url, openwin, style);
	return rt;
}
//�J���Č��o�^
function OpenPJ02(actionMode, proVerId, openwin){
	var url=GetPopupPatch() + "pop/popFrame.jsp?pageId=PJ02_s&actionMode=" + actionMode + "&proVerId=" + proVerId + "&time=" + GetSysTime();
	var style="dialogWidth:800px;dialogHeight:350px;resizable: no;status:no;unadorned:no;edge:raised;";
	var rt = DoOpenModalDialog(url, openwin, style);
	return rt;
}
function openPatternSel(proVerId,openwin){
	var url=GetPopupPatch() + "pop/popFrame.jsp?pageId=PJ05_s&proVerId=" + proVerId + "&time=" + GetSysTime();
	var style="dialogWidth:700px;dialogHeight:250px;resizable: no;status:no;unadorned:no;edge:raised;";
	var rt = DoOpenModalDialog(url, openwin, style);
	return rt;
}
function openProReg(proVerId,openwin){
	var url=GetPopupPatch() + "pop/popFrame.jsp?pageId=PJ03_s&proVerId=" + proVerId + "&time=" + GetSysTime();
	var style="dialogWidth:1000px;dialogHeight:650px;resizable:no;status:no;unadorned:no;edge:raised;";
	var rt = DoOpenModalDialog(url, openwin, style);
	return rt;
}
