import os
from dotenv import load_dotenv
import sys
import smtplib
import ssl
from email.message import EmailMessage

# Cargar las variables de entorno
load_dotenv(dotenv_path='../config/.env')

email_sender = 'lostpaws7@gmail.com'
email_password = os.getenv('EMAIL_PASSWORD')
email_receiver = sys.argv[1]

print(f"Email sender: {email_sender}")
print(f"Email receiver: {email_receiver}")

# Enviar el correo electrónico
subject = 'Solicitud de Adopción en Revisión'
body = """
Hola,

Tu solicitud de adopción está actualmente en revisión. Te notificaremos una vez que tengamos una decisión final.

Gracias por tu paciencia.
"""

em = EmailMessage()
em['From'] = email_sender
em['To'] = email_receiver
em['Subject'] = subject
em.set_content(body)

context = ssl.create_default_context()
try:
    with smtplib.SMTP_SSL('smtp.gmail.com', 465, context=context) as smtp:
        smtp.login(email_sender, email_password)
        smtp.sendmail(email_sender, email_receiver, em.as_string())
        print("Correo enviado exitosamente")
except Exception as e:
    print(f"Error al enviar el correo: {e}")
    sys.exit(1)
