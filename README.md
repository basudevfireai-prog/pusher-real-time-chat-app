Laravel-e Pusher ebong Blade file bebohar kore ekti real-time chat system toiri korar step-by-step process niche dewa holo. Amra ekhane **Laravel Broadcasting** concept bebohar korbo.

### **Step 1: Pusher Account Setup**

1. [Pusher.com](https://pusher.com/)\-e ekti account toiri korun.  
2. Dashboard theke "Create App" korun (Cluster: ap2 ba mt1 select korun).  
3. "App Keys" tab theke app\_id, key, secret, ebong cluster copy korun.

### **Step 2: Install Packages**

Terminal-e nicher command-ti diye Pusher-er server-side SDK install korun:

Bash

composer require pusher/pusher-php-server

### **Step 3: Configure .env File**

Apnar .env file-e Pusher-er key-gulo add korun ebong BROADCAST\_DRIVER update korun:

Code snippet

BROADCAST\_DRIVER=pusher

PUSHER\_APP\_ID=apnar\_app\_id  
PUSHER\_APP\_KEY=apnar\_key  
PUSHER\_APP\_SECRET=apnar\_secret  
PUSHER\_APP\_CLUSTER=ap2

### **Step 4: Create Event**

Ekti event generate korun ja backend theke frontend-e data pathabe.

Bash

php artisan make:event MessageSent

### **Step 5: Chat Controller**

Message receive ebong event fire korar jonno controller toiri korun.

Chat Controller  
Dec 30, 6:14 PM  
Open

### **Step 6: Frontend View (Blade with Pusher JS)**

Blade file-e amra **Pusher JS** library bebohar korbo message listen korar jonno.

Updated Chat Logic  
Dec 30, 9:07 PM  
Open

### **Step 7: Define Routes**

routes/web.php file-e nicher route-gulo add korun:

Web Routes  
Dec 30, 6:14 PM  
Open

### **How it works:**

1. **User Input:** User jokhon input diye "Send" e click kore, tokhon jQuery $.post diye Controller-e data pathay.  
2. **Event Dispatch:** Controller MessageSent event-ti broadcast kore.  
3. **Pusher Server:** Laravel event-ti Pusher server-e pathiye dey.  
4. **Real-time Update:** Pusher server protiti connected browser-ke (jekhane chat open ache) message-ti pathiye dey.  
5. **Pusher JS:** Browser-e thaka JavaScript message-ti receive kore ebong appendMessage() function diye screen-e dekhay.

Eivabe page refresh charai real-time communication kaj kore. Prothome Laragon start kore php artisan serve diye check korte paren.

**Tips:** Laravel 11-er khetre app.php-te broadcasting enable kora thakte hoy (php artisan install:broadcasting command-ti run kore nite paren).
