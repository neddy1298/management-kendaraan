const cron = require('node-cron');
const shell = require('shelljs');

cron.schedule('* 1 * * *', () => {
    console.log('running a task every minute');
    shell.exec('php artisan schedule:run 1>> /dev/null 2>&1');
});

// 0 22 * * 1-5