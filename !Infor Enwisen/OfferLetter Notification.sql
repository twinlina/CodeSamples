/*******************************
This is the SQL query for an automated email that sends when a user finishes the Offer Letter smart form I created. It grabs new hire data to populate the email as well as grabbing the user that should receive the email. In this case it will send to the new hire's manager: MgrEmail
*******************************/

SELECT DISTINCT pnh.userID AS UserID, 
    (isnull(pnh.firstname,'') + ' ' + isnull(pnh.lastname,'')) as NewHireName, 
    pnh.EmployeeID as NewHireID,
    pnhc.hmemail as MgrEmail,
    (select AccountID from t_cususer where emailAddress = pnhc.HiringManageremail) MgrID,
    (select firstname+' '+lastname from t_cususer where accountid = pnh.RecruiterUserId) RecruiterName, 
    isNull(pnh.Address1,'') + ' ' + isNull(pnh.Address2,'') AS Address,
    isNull(pnh.City,'') + ' ' + isNull(pnh.State,'') + ' ' + isNull(pnh.PostalCode, '') AS Address2,
    pnh.Prefix as Prefix,
	pnh.JobTitle as JobTitle,
	pnh.Division as Site,
    tcus.Classification as Shift,
    pnhc.HRWage as Wage,
	pnhc.BenefitSpecialScheduleDescr as BenefitStatus,
    (case when upper(OTPLANDESCR)='H' then 'Hourly' when upper(OTPLANDESCR)='S' then 'Salary' else OTPLANDESCR end) as Position,
    pnhc.hmname as Supervisor,
    pnhc.hmphone as SupPhone,
    (convert (varchar, tcus.hireDate, 101)) as HireDate,
	CONVERT(varchar(10), GETDATE(), 101) as Date
FROM procNewHires pnh
INNER JOIN T_cusUser tcus ON pnh.UserID = tcus.AccountID
INNER JOIN procnewhirescustom pnhc ON pnh.UserID = pnhc.UserID
INNER JOIN envuserprocesses eup on eup.userid = pnh.userid AND eup.processcode = 'Onboarding'
INNER JOIN EnvProcessTracking ept on eup.Id = ept.UserProcessId
INNER JOIN EnvProcessSteps eps on ept.StepId = eps.StepId and eps.FormCode = 'onbd-form-f-offerletter'
WHERE ept.StepStatus = 'Complete'
	AND (datediff(day, ept.EditDate,getdate()) = 0 OR datediff(day, ept.CreateDate,getdate()) = 0)
	

/*******************************
This is the HTML email that sends. In this case it is a copy of the content in the SmartForm.
*******************************/

<font face='verdana' size='2'>
<p><xsl:value-of select='//Table/Date'></xsl:value-of></p>

<p><xsl:value-of select='//Table/NewHireName'></xsl:value-of><br />
<xsl:value-of select='//Table/Address'></xsl:value-of><br />
<xsl:value-of select='//Table/Address2'></xsl:value-of></p>

<p>Dear <xsl:value-of select='//Table/Prefix'></xsl:value-of> <xsl:value-of select='//Table/NewHireName'></xsl:value-of>,</p>

<p>We are pleased to confirm your acceptance of our conditional offer of employment as <xsl:value-of select='//Table/JobTitle'></xsl:value-of> at the Detroit Medical Center at <xsl:value-of select='//Table/Site'></xsl:value-of>. Further details of your position are:</p>

<p>Shift: <xsl:value-of select='//Table/Shift'></xsl:value-of><br />
Benefit Status: <xsl:value-of select='//Table/BenefitStatus'></xsl:value-of><br />
Pay Rate: <xsl:value-of select='//Table/Wage'></xsl:value-of><br />
Type of position: <xsl:value-of select='//Table/Position'></xsl:value-of><br />
Supervisor: <xsl:value-of select='//Table/Supervisor'></xsl:value-of>, who can be reached at <xsl:value-of select='//Table/SupPhone'></xsl:value-of><br />
Employee ID#: <xsl:value-of select='//Table/NewHireID'></xsl:value-of><br />
TENTATIVE Start Date: <xsl:value-of select='//Table/HireDate'></xsl:value-of></p>

<p>Per Detroit Medical Center policy, all job offers are contingent upon successful completion of: 1&#41; a pre-employment physical exam, which includes a drug screen, nicotine screen, antibody TITERS testing, flu vaccination and TB skin test; 2&#41; reference verification; 3&#41; criminal background check, 4&#41; employment eligibility verification, &#40;Completion of the I-9 Form requires that you provide documentation which supports your legal right to work in the U.S.&#41; and 5&#41; completion of Compliance &#40;Net Learning&#41; Training, all prior to your start date. Your hire is also dependent upon the DMC having a continuing need for personnel in the position offered as of your start date.</p>

<p>Under state and federal law, if you require a reasonable accommodation to perform the work for which you have been hired, please notify a member of the staff where your physical is conducted.</p>

<p>Human Resources will contact you to confirm your start date once the above requirements have been satisfied.   We are looking forward to having you join the Detroit Medical Center. If you have any questions regarding the new hire process, please contact me, or our campus recruiting team general line:</p>
<table border="0" cellpadding="2" style="margin-left:10px;margin-top:0">
<tr style="font-family:verdana;font-size:12px"><td style="padding:0 5px;">Midtown Nursing</td><td style="padding:0 5px;">313/578-3033</td></tr>
<tr style="font-family:verdana;font-size:12px"><td style="padding:0 5px;">Midtown Non-Nursing</td><td style="padding:0 5px;">313/578-3980</td></tr>
<tr style="font-family:verdana;font-size:12px"><td style="padding:0 5px;">Sinai-Grace</td><td style="padding:0 5px;">313/966-3101</td></tr>
<tr style="font-family:verdana;font-size:12px"><td style="padding:0 5px;">Huron Valley - Sinai</td><td style="padding:0 5px;">248/937-4041</td></tr>
</table>

<p>Sincerely,<br />
<xsl:value-of select='//Table/RecruiterName'></xsl:value-of><br />
Recruiter</p>

<p>Cc: Employee file</p>

<p>By typing my full legal name below, I am signing and indicate my acceptance of the offer as described above.
E-Signature:</p>
<table border="0" cellpadding="2" style="margin-left:10px;margin-top:0">
<tr style="font-family:verdana;font-size:12px;text-decoration:underline;"><td width="40%" style="padding:0 5px;"><xsl:value-of select='//Table/NewHireName'></xsl:value-of></td><td width="40%" style="padding:0 5px;"><xsl:value-of select='//Table/Date'></xsl:value-of></td></tr>
<tr style="font-family:verdana;font-size:12px"><td style="padding:0 5px;">&#40;Legal Full Name&#41;</td><td style="padding:0 5px;">Date</td></tr>
</table>
</font>