/**
 * Navigation buttons code lines.
 */

/**
 * Selection of div tags with IDs that contain the information to be displayed.
 */
const userManagementPanel = document.getElementById("userManagementPanel")
const publicNotesManagementPanel = document.getElementById("publicNotesManagementPanel")
const privateNotesManagementPanel = document.getElementById("privateNotesManagementPanel")
const appSettingsManagementPanel = document.getElementById("appSettingsManagementPanel")
//const userManagementPanel = document.getElementById("userManagementPanel")

/**
 * Selection of the buttons to navigate though content.
 */
const btnUsers = document.getElementById("btnUsers")
const btnPublicNotes = document.getElementById("btnPublicNotes")
const btnPrivateNotes = document.getElementById("btnPrivateNotes")
const btnAppSettings = document.getElementById("btnAppSettings")

/**
 * Hide and show information when buttons pressed.
 */
function usersDisplayToggle() {
    userManagementPanel.style.display = "inline";
    publicNotesManagementPanel.style.display = "none";
    privateNotesManagementPanel.style.display = "none";
    appSettingsManagementPanel.style.display = "none";
    usersBtnGainFocus();
}

function publicNotesDisplay() {
    userManagementPanel.style.display = "none";
    publicNotesManagementPanel.style.display = "inline";
    privateNotesManagementPanel.style.display = "none";
    appSettingsManagementPanel.style.display = "none";
    publicNotesBtnGainFocus();
}

function privateNotesDisplay() {
    userManagementPanel.style.display = "none";
    publicNotesManagementPanel.style.display = "none";
    privateNotesManagementPanel.style.display = "inline";
    appSettingsManagementPanel.style.display = "none";
    privateNotesBtnGainFocus();
}

function addSettingsDisplay() {
    userManagementPanel.style.display = "none";
    publicNotesManagementPanel.style.display = "none";
    privateNotesManagementPanel.style.display = "none";
    appSettingsManagementPanel.style.display = "inline";
    appSettingsBtnGainFocus();
}

/**
 * Change navbar colors when buttons pressed.
 * For example, by default the "Users" button is
 * already pressed. If user presses "Public notes"
 * this button will gain color and "Users" will lose
 * it.
 */

function usersBtnGainFocus() {
    btnUsers.classList.add("active");
    btnPublicNotes.classList.remove("active");
    btnPrivateNotes.classList.remove("active");
    btnAppSettings.classList.remove("active");
}

function publicNotesBtnGainFocus() {
    btnUsers.classList.remove("active");
    btnPublicNotes.classList.add("active");
    btnPrivateNotes.classList.remove("active");
    btnAppSettings.classList.remove("active");
}

function privateNotesBtnGainFocus() {
    btnUsers.classList.remove("active");
    btnPublicNotes.classList.remove("active");
    btnPrivateNotes.classList.add("active");
    btnAppSettings.classList.remove("active");
}

function appSettingsBtnGainFocus() {
    btnUsers.classList.remove("active");
    btnPublicNotes.classList.remove("active");
    btnPrivateNotes.classList.remove("active");
    btnAppSettings.classList.add("active");
}
