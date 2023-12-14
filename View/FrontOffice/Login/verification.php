<?php
session_start();

include("../../../Controller/UserC.php");
include '../../../Model/User.php';

$UserC = new UserC();

$User = isset($_SESSION['user_data']) ? $_SESSION['user_data'] : null;

// Print user data

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['verification_code'])) {
    $verificationCode = $_POST['verification_code'];

    // Validate the input (e.g., length and format)
    if (isValidVerificationCode($verificationCode)) {
        if (isset($_SESSION['verification_code']) && $_SESSION['verification_code'] === $verificationCode) {
            // Verification code matches the one stored in the session
            unset($_SESSION['verification_code']); // Remove the stored verification code

            

            // Check if user data is in the session
            if ($User) {
                

                
                $userInstance = new User(
                    null, // You may set null for Id_User if it's auto-incremented in the database
                    $_SESSION['user_data']['Name'],
                    $_SESSION['user_data']['Lname'],
                    $_SESSION['user_data']['Email'],
                    $_SESSION['user_data']['Username'],
                    md5($_SESSION['user_data']['Password']),
                    $_SESSION['user_data']['Adress'],
                    $_SESSION['user_data']['University'],
                    $_SESSION['user_data']['classe'],
                    $_SESSION['user_data']['media']
                );
                
                print_r($userInstance);

                $UserC->addUser($userInstance);

                // Clear user data from the session
                unset($_SESSION['user_data']);

                // Provide feedback to the user
                

                // Redirect to a success page or login page after a delay
                header("refresh:5;url=index.php"); // Redirect after 5 seconds
                exit();
            } else {
                $error = "User data not found in the session.";
            }
        } else {
            $error = "Invalid or expired verification code. Please try again.";
        }
    } else {
        $error = "Invalid verification code format. Please enter a valid code.";
    }
}

function isValidVerificationCode($code)
{
    return strlen($code) === 32 && ctype_xdigit($code);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

    <title>Email Verification</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #495057;
            text-align: center;
            margin: 0;
            overflow: hidden; /* Prevent default margin on body */
        }

        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            background-color: #f8f9fa;
            z-index: -1;
        }

        h1,
        form,
        p {
            position: relative;
            z-index: 1;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-in-out;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #495057;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #721c24;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            animation: fadeIn 1s ease-in-out;
        }

        button:hover {
            background-color: #4d1318;
            animation: scaleUp 0.3s ease-in-out;
        }

        p {
            margin-top: 20px;
            font-size: 16px;
            line-height: 1.6;
        }

        .error-message {
            color: #dc3545;
            animation: fadeIn 1s ease-in-out;
        }

        .success-message {
            color: #28a745;
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
            }
            to {
                transform: translateY(0);
            }
        }

        @keyframes scaleUp {
            from {
                transform: scale(1);
            }
            to {
                transform: scale(1.1);
            }
        }
    </style>
</head>

<body>
    <div id="particles-js"></div>
    <h1>Email Verification</h1>
    <?php if (isset($error)) : ?>
        <p class="error-message"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if (isset($successMessage)) : ?>
        <p class="success-message"><?php echo $successMessage; ?></p>
    <?php endif; ?>

    <form method="post" action="">
        <label for="verification_code">Enter the verification code sent to your email:</label>
        <input type="text" id="verification_code" name="verification_code" required>
        <button type="submit">Verify</button>
    </form>

    <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
    <script>
        particlesJS('particles-js', {
            particles: {
                number: {
                    value: 80,
                    density: {
                        enable: true,
                        value_area: 800
                    }
                },
                color: {
                    value: '#721c24'
                },
                shape: {
                    type: 'circle',
                    stroke: {
                        width: 0,
                        color: '#721c24'
                    },
                    polygon: {
                        nb_sides: 5
                    }
                },
                opacity: {
                    value: 0.5,
                    random: true,
                    anim: {
                        enable: true,
                        speed: 1,
                        opacity_min: 0.1,
                        sync: false
                    }
                },
                size: {
                    value: 5,
                    random: true,
                    anim: {
                        enable: true,
                        speed: 2,
                        size_min: 0.1,
                        sync: false
                    }
                },
                line_linked: {
                    enable: false
                },
                move: {
                    enable: true,
                    speed: 1,
                    direction: 'none',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    bounce: false,
                    attract: {
                        enable: false,
                        rotateX: 600,
                        rotateY: 600
                    }
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: {
                        enable: true,
                        mode: 'grab'
                    },
                    onclick: {
                        enable: true,
                        mode: 'push'
                    },
                    resize: true
                },
                modes: {
                    grab: {
                        distance: 140,
                        line_linked: {
                            opacity: 0.5
                        }
                    },
                    push: {
                        particles_nb: 4
                    }
                }
            },
            retina_detect: true
        });
    </script>
</body>

</html>

