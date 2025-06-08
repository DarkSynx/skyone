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
  const url = process.env.SKYONE_URL || 'http://localhost:8080/index.php';
  win.loadURL(url);
}
app.whenReady().then(createWindow);
