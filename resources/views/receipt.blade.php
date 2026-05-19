<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sertifikat Pendukung Resmi - {{ $payment->id }}</title>
    <link rel="icon" type="image/png" href="/images/favicon.png?v=3">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@500;700;900&family=Outfit:wght@300;400;600;700&family=Pinyon+Script&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #070d0a;
            color: #f3f4f6;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100/v;
            height: 100vh;
        }

        /* Certificate Main Layout */
        .certificate-wrapper {
            width: 900px;
            height: 600px;
            background-color: #0b1410;
            border: 15px solid #050a08;
            box-shadow: 0 0 50px rgba(0,0,0,0.8);
            position: relative;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 40px;
            overflow: hidden;
        }

        /* Gold Ornate Borders */
        .certificate-border-line {
            position: absolute;
            inset: 15px;
            border: 3px double #d97706;
            pointer-events: none;
            opacity: 0.8;
        }

        .corner-decoration {
            position: absolute;
            width: 40px;
            height: 40px;
            border: 2px solid #d97706;
            pointer-events: none;
        }
        .top-left { top: 25px; left: 25px; border-right: none; border-bottom: none; }
        .top-right { top: 25px; right: 25px; border-left: none; border-bottom: none; }
        .bottom-left { bottom: 25px; left: 25px; border-right: none; border-top: none; }
        .bottom-right { bottom: 25px; right: 25px; border-left: none; border-top: none; }

        /* Header Styles */
        .cert-header {
            text-align: center;
            z-index: 10;
        }
        .cert-logo {
            font-family: 'Cinzel', serif;
            font-size: 14px;
            letter-spacing: 6px;
            color: #facc15;
            margin-bottom: 5px;
            font-weight: 700;
        }
        .cert-sublogo {
            font-size: 10px;
            letter-spacing: 4px;
            color: #34d399;
            text-transform: uppercase;
        }

        /* Certificate Title */
        .cert-title {
            font-family: 'Cinzel', serif;
            font-size: 26px;
            font-weight: 900;
            color: #ffffff;
            letter-spacing: 5px;
            margin: 25px 0 5px 0;
            text-align: center;
            text-shadow: 0 2px 4px rgba(0,0,0,0.5);
            background: linear-gradient(135deg, #facc15 0%, #d97706 50%, #fef08a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            z-index: 10;
        }

        .cert-subtitle {
            font-size: 12px;
            letter-spacing: 2px;
            color: #9ca3af;
            text-transform: uppercase;
            margin-bottom: 25px;
            z-index: 10;
        }

        /* Certificate Content Body */
        .cert-body {
            text-align: center;
            max-width: 700px;
            z-index: 10;
        }
        .cert-text {
            font-size: 13px;
            color: #9ca3af;
            line-height: 1.6;
            margin-bottom: 10px;
            font-weight: 300;
        }
        .voter-name {
            font-family: 'Cinzel', serif;
            font-size: 24px;
            font-weight: 700;
            color: #ffffff;
            margin: 15px 0;
            letter-spacing: 2px;
            border-bottom: 1px solid rgba(217,119,6,0.3);
            display: inline-block;
            padding-bottom: 5px;
        }
        .support-details {
            font-size: 14px;
            color: #34d399;
            font-weight: 600;
            margin-top: 15px;
            letter-spacing: 1px;
        }
        .candidate-name {
            color: #facc15;
            font-family: 'Cinzel', serif;
            font-size: 18px;
            margin: 5px 0;
        }

        /* Certificate Footer */
        .cert-footer {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding: 0 40px;
            box-sizing: border-box;
            z-index: 10;
        }
        
        .signature-block {
            text-align: center;
            width: 200px;
        }
        .signature-line {
            width: 100%;
            border-bottom: 1px solid rgba(156, 163, 175, 0.4);
            margin-bottom: 8px;
        }
        .signature-name {
            font-size: 11px;
            font-weight: 600;
            color: #ffffff;
            letter-spacing: 1px;
        }
        .signature-title {
            font-size: 9px;
            color: #6b7280;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 2px;
        }
        .fancy-sig {
            font-family: 'Pinyon Script', cursive;
            font-size: 28px;
            color: #d97706;
            line-height: 1;
            margin-bottom: -10px;
        }

        /* Gold Seal Decoration */
        .gold-seal-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .gold-seal {
            width: 70px;
            height: 70px;
            background: radial-gradient(circle, #fef08a 0%, #facc15 40%, #d97706 100%);
            border-radius: 50%;
            box-shadow: 0 0 15px rgba(217,119,6,0.3);
            border: 2px dashed #b45309;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }
        .gold-seal-inner {
            width: 54px;
            height: 54px;
            border: 1px solid #78350f;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Cinzel', serif;
            font-size: 8px;
            font-weight: 900;
            color: #78350f;
            text-align: center;
            letter-spacing: 0.5px;
            line-height: 1.2;
        }
        .seal-ribbon {
            position: absolute;
            bottom: -20px;
            width: 15px;
            height: 40px;
            background-color: #b45309;
            clip-path: polygon(0 0, 100% 0, 50% 100%);
            z-index: -1;
        }
        .ribbon-left { left: 15px; transform: rotate(15deg); }
        .ribbon-right { right: 15px; transform: rotate(-15deg); }

        .cert-id {
            font-family: 'Outfit', sans-serif;
            font-size: 9px;
            color: #6b7280;
            letter-spacing: 2px;
            margin-top: 10px;
        }

        /* Print Controls Screen Only */
        .print-controls {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 100;
            display: flex;
            gap: 10px;
        }
        .btn-action {
            font-family: 'Outfit', sans-serif;
            font-size: 11px;
            font-weight: bold;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 10px 18px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
        }
        .btn-print {
            background: linear-gradient(135deg, #facc15 0%, #d97706 100%);
            color: #070d0a;
        }
        .btn-print:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(217,119,6,0.3);
        }
        .btn-back {
            background-color: #1f2937;
            color: #f3f4f6;
            border: 1px solid rgba(255,255,255,0.05);
        }
        .btn-back:hover {
            background-color: #374151;
            transform: translateY(-2px);
        }

        /* Print Styles */
        @media print {
            body {
                background-color: #ffffff;
                color: #000000;
            }
            .print-controls {
                display: none;
            }
            .certificate-wrapper {
                width: 100% !important;
                height: 100% !important;
                border: none !important;
                background-color: #0b1410 !important;
                color-adjust: exact;
                -webkit-print-color-adjust: exact;
                box-shadow: none !important;
                position: fixed;
                left: 0;
                top: 0;
            }
        }
    </style>
</head>
<body>

    <!-- 🖨️ Floating Print Action Controls -->
    <div class="print-controls">
        <button onclick="window.history.back()" class="btn-action btn-back">Kembali</button>
        <button onclick="window.print()" class="btn-action btn-print">Cetak Sertifikat</button>
    </div>

    <!-- 📜 Luxury A4 Landscape Supporting Certificate -->
    <div class="certificate-wrapper">
        <!-- Borders and decorations -->
        <div class="certificate-border-line"></div>
        <div class="corner-decoration top-left"></div>
        <div class="corner-decoration top-right"></div>
        <div class="corner-decoration bottom-left"></div>
        <div class="corner-decoration bottom-right"></div>

        <!-- Certificate Header -->
        <div class="cert-header" style="display: flex; align-items: center; justify-content: center; gap: 20px; z-index: 10; margin-bottom: -10px;">
            <!-- UIN Logo in White Circle -->
            <div style="width: 72px; height: 72px; border-radius: 50%; background-color: #ffffff; border: 2px solid #ffffff; display: flex; align-items: center; justify-content: center; padding: 4px; box-shadow: 0 4px 6px rgba(0,0,0,0.15); overflow: hidden; flex-shrink: 0;">
                <img src="/images/logo_uin.png" alt="UIN Logo" style="height: 100%; width: 100%; object-fit: contain;">
            </div>
            <div style="text-align: center;">
                <div class="cert-logo">PRINCE & PRINCESS</div>
                <div class="cert-sublogo">ENGLISH DEPARTMENT UIN MADURA 2026</div>
            </div>
            <!-- Department Logo in White Circle -->
            <div style="width: 72px; height: 72px; border-radius: 50%; background-color: #ffffff; border: 2px solid #ffffff; display: flex; align-items: center; justify-content: center; padding: 4px; box-shadow: 0 4px 6px rgba(0,0,0,0.15); overflow: hidden; flex-shrink: 0;">
                <img src="/images/logo_department.png" alt="Dept Logo" style="height: 100%; width: 100%; object-fit: contain;">
            </div>
        </div>

        <!-- Main Body -->
        <div class="cert-body">
            <div class="cert-title">SERTIFIKAT PENDUKUNG RESMI</div>
            <div class="cert-subtitle">Official Supporter Appreciation Certificate</div>
            
            <div class="cert-text">Sertifikat ini dianugerahkan dengan penuh kehormatan dan apresiasi kepada:</div>
            <div class="voter-name">{{ $payment->voter_name }}</div>
            <div class="cert-text" style="max-width: 600px; margin: 0 auto;">
                Atas partisipasi aktif dan kontribusi nyata dalam memberikan dukungan suara e-voting sebanyak <strong>{{ $payment->vote_amount }} suara</strong> untuk mendukung Finalis pilihan:
            </div>
            <div class="support-details">
                KATEGORI {{ strtoupper($payment->candidate->gender) }} PRINCE & PRINCESS ENGLISH DEPARTMENT
                <div class="candidate-name">{{ strtoupper($payment->candidate->gender) === 'PUTRA' ? 'PRINCE' : 'PRINCESS' }} {{ $payment->candidate->name }} (No. {{ $payment->candidate->candidate_number }})</div>
            </div>
        </div>

        <!-- Certificate Footer -->
        <div class="cert-footer">
            <!-- Left Signature: Organizer -->
            <div class="signature-block">
                <div class="fancy-sig">Akhmad Wildan</div>
                <div class="signature-line"></div>
                <div class="signature-name">Dr. H. Ahmad Wildan, M.Pd.</div>
                <div class="signature-title">Ketua Panitia Penyelenggara</div>
            </div>

            <!-- Center: Gold Seal -->
            <div class="gold-seal-container">
                <div class="gold-seal">
                    <div class="gold-seal-inner">
                        PRINCE &<br>PRINCESS<br>ESA 2026
                    </div>
                    <div class="seal-ribbon ribbon-left"></div>
                    <div class="seal-ribbon ribbon-right"></div>
                </div>
                <div class="cert-id">INVOICE: {{ $payment->id }}</div>
            </div>

            <!-- Right Signature: President of Student Council -->
            <div class="signature-block">
                <div class="fancy-sig">Farid Alfarisi</div>
                <div class="signature-line"></div>
                <div class="signature-name">Farid Al-Farisi, S.H.</div>
                <div class="signature-title">Presiden Dewan Mahasiswa</div>
            </div>
        </div>
    </div>

</body>
</html>
