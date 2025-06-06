const {app, BrowserWindow} = require('electron');
const path = require('path');

function createWindow () {
  const win = new BrowserWindow({
    width: 1000,
    height: 800,
    webPreferences: {
      nodeIntegration: false
    }
  });
  win.loadURL('https://172.19.21.125/index.php');
}
app.whenReady().then(createWindow);
